class CartManager {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateCartCount();
    }

    bindEvents() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('.add-to-cart-btn')) {
                e.preventDefault();
                this.handleAddToCart(e.target.closest('.add-to-cart-btn'));
            }
        });

        if (window.location.pathname.includes('/cart')) {
            this.bindCartPageEvents();
        }
    }

    async handleAddToCart(button) {
        const productId = button.dataset.productId;
        const isShowPage = document.querySelector('.product-slider') !== null;
        
        if (isShowPage) {
            return this.handleShowPageCart(button, productId);
        } else {
            return this.handleCardPageCart(button, productId);
        }
    }

	async handleShowPageCart(button, productId) {
		const quantity = parseInt(document.getElementById('quantity')?.value || 1);
		const selectedVariations = this.collectSelectedVariations();
		const availableVariations = document.querySelectorAll('.attribute-btn, .color-btn');
		
		console.log('HandleShowPageCart - selected variations:', selectedVariations);
		// alert('Debug: Selected variations = ' + JSON.stringify(selectedVariations) + '. Check console for details.');
		
		if (availableVariations.length > 0) {
			const hasSelection = this.validateVariationSelection();
			if (!hasSelection.valid) {
				this.showError(`Please select ${hasSelection.missing.join(', ')}`);
				return;
			}
		}

		const success = await this.addToCart(productId, quantity, selectedVariations);
		if (success) {
			window.location.href = '/cart';
		}
	}


    async handleCardPageCart(button, productId) {
        const defaultVariations = this.getDefaultVariations(productId);
        const success = await this.addToCart(productId, 1, defaultVariations);
        if (success) {
            window.location.href = '/cart';
        }
    }


	validateVariationSelection() {
		const attributeGroups = {};
		const missing = [];
		
		document.querySelectorAll('.attribute-btn, .color-btn').forEach(btn => {
			const attribute = btn.dataset.attribute;
			if (!attributeGroups[attribute]) {
				attributeGroups[attribute] = { hasSelection: false, name: attribute };
			}
			if (btn.classList.contains('active')) {
				attributeGroups[attribute].hasSelection = true;
			}
		});
		
		Object.values(attributeGroups).forEach(group => {
			if (!group.hasSelection) {
				missing.push(group.name);
			}
		});
		
		console.log('Validation result:', { valid: missing.length === 0, missing }); // Debug log
		
		return {
			valid: missing.length === 0,
			missing: missing
		};
	}


    getDefaultVariations(productId) {
        const defaults = [];
        const seenAttributes = new Set();
        
        document.querySelectorAll(`[data-product-id="${productId}"]`).forEach(card => {
            const variationElements = card.querySelectorAll('[data-variation-id]');
            variationElements.forEach(element => {
                const attribute = element.dataset.attribute;
                if (attribute && !seenAttributes.has(attribute)) {
                    defaults.push(parseInt(element.dataset.variationId));
                    seenAttributes.add(attribute);
                }
            });
        });
        
        return defaults;
    }

    async addToCart(productId, quantity, variations = []) {
        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity,
                    variations: variations
                })
            });

            const data = await response.json();

            if (data.success) {
                this.updateCartCount(data.cart_count);
                this.showSuccess(data.message || 'Added to cart!');
                return true;
            } else {
                this.showError(data.message || 'Failed to add to cart');
                return false;
            }
        } catch (error) {
            console.error('Cart error:', error);
            this.showError('Network error. Please try again.');
            return false;
        }
    }

    bindCartPageEvents() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('.quantity-btn')) {
                this.handleQuantityChange(e.target.closest('.quantity-btn'));
            }
            
            if (e.target.closest('.remove-item')) {
                this.handleRemoveItem(e.target.closest('.remove-item'));
            }
            
            if (e.target.closest('#clear-cart')) {
                this.handleClearCart();
            }
            
            if (e.target.closest('.variation-selector')) {
                this.handleVariationChange(e.target.closest('.variation-selector'));
            }
        });

        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('quantity-input')) {
                this.handleQuantityInput(e.target);
            }
        });
    }

    async handleQuantityChange(button) {
        const action = button.dataset.action;
        const cartItem = button.closest('.cart-item');
        const quantityInput = cartItem.querySelector('.quantity-input');
        let currentQuantity = parseInt(quantityInput.value);
        
        if (action === 'increase') {
            currentQuantity++;
        } else if (action === 'decrease' && currentQuantity > 1) {
            currentQuantity--;
        }
        
        quantityInput.value = currentQuantity;
        await this.updateCartItem(cartItem.dataset.itemId, currentQuantity);
    }

    async handleQuantityInput(input) {
        const quantity = Math.max(1, parseInt(input.value) || 1);
        input.value = quantity;
        const cartItem = input.closest('.cart-item');
        await this.updateCartItem(cartItem.dataset.itemId, quantity);
    }

    async handleRemoveItem(button) {
        if (!confirm('Remove this item from cart?')) return;
        
        const cartItem = button.closest('.cart-item');
        const itemId = cartItem.dataset.itemId;
        
        const success = await this.removeCartItem(itemId);
        if (success) {
            cartItem.remove();
            this.checkEmptyCart();
        }
    }

    async handleClearCart() {
        if (!confirm('Clear entire cart?')) return;
        
        const success = await this.clearCart();
        if (success) {
            location.reload();
        }
    }

    async handleVariationChange(selector) {
        const cartItem = selector.closest('.cart-item');
        const itemId = cartItem.dataset.itemId;
        const variationId = selector.value;
        
        await this.updateCartItemVariation(itemId, variationId);
    }

    async updateCartItem(itemId, quantity) {
        try {
            const response = await fetch(`/cart/update/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ quantity })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.updateCartDisplay(itemId, data);
                return true;
            } else {
                this.showError(data.message);
                return false;
            }
        } catch (error) {
            console.error('Update error:', error);
            this.showError('Failed to update cart');
            return false;
        }
    }

    async updateCartItemVariation(itemId, variationId) {
        try {
            const response = await fetch(`/cart/update-variation/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ variation_id: variationId })
            });
            
            const data = await response.json();
            
            if (data.success) {
                location.reload(); 
            } else {
                this.showError(data.message);
            }
        } catch (error) {
            console.error('Variation update error:', error);
        }
    }

    async removeCartItem(itemId) {
        try {
            const response = await fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.updateCartCount(data.cart_count);
                this.updateTotals(data.cart_total);
                return true;
            }
            return false;
        } catch (error) {
            console.error('Remove error:', error);
            return false;
        }
    }

    async clearCart() {
        try {
            const response = await fetch('/cart/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const data = await response.json();
            return data.success;
        } catch (error) {
            console.error('Clear error:', error);
            return false;
        }
    }

    updateCartDisplay(itemId, data) {
        const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
        if (cartItem) {
            const itemTotal = cartItem.querySelector('.item-total');
            if (itemTotal) {
                itemTotal.textContent = `$${data.item_total}`;
            }
        }
        
        this.updateTotals(data.cart_total);
        this.updateCartCount(data.cart_count);
    }

    updateTotals(total) {
        document.querySelectorAll('.cart-total').forEach(el => {
            el.textContent = `$${total}`;
        });
    }

    async updateCartCount(count = null) {
        if (count === null) {
            try {
                const response = await fetch('/cart/count');
                const data = await response.json();
                count = data.count;
            } catch (error) {
                return;
            }
        }
        
        document.querySelectorAll('.cart-count').forEach(el => {
            el.textContent = count || '0';
        });
        
        document.querySelectorAll('.cart-badge').forEach(badge => {
            badge.style.display = count > 0 ? 'block' : 'none';
        });
    }

    checkEmptyCart() {
        if (document.querySelectorAll('.cart-item').length === 0) {
            location.reload();
        }
    }

    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showNotification(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white max-w-sm ${
            type === 'success' ? 'bg-green-600' : 
            type === 'error' ? 'bg-red-600' : 'bg-blue-600'
        }`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 3000);
    }

    initShowPageVariations() {
        if (!document.querySelector('.product-slider')) return;
        
        const attributeGroups = {};
        
        document.querySelectorAll('.attribute-btn, .color-btn').forEach(btn => {
            const attribute = btn.dataset.attribute;
            if (!attributeGroups[attribute]) {
                attributeGroups[attribute] = btn;
            }
        });
        
        Object.values(attributeGroups).forEach(btn => {
            btn.classList.add('active');
        });
    }
	getDefaultVariations(productId) {
		const defaults = [];
		
		document.querySelectorAll(`.default-variation[data-product-id="${productId}"]`).forEach(span => {
			const variationId = span.dataset.variationId;
			if (variationId && !defaults.includes(parseInt(variationId))) {
				defaults.push(parseInt(variationId));
			}
		});
		
		return defaults;
	}
	collectSelectedVariations() {
		const selectedAttributes = {};
		
		document.querySelectorAll('.attribute-btn.active, .color-btn.active').forEach(btn => {
			const attribute = btn.dataset.attribute;
			const value = btn.dataset.value;
			if (attribute && value) {
				selectedAttributes[attribute] = value;
			}
		});
		
		// console.log('Cart.js - Selected attributes:', selectedAttributes);
		
		const sortedAttributes = {};
		Object.keys(selectedAttributes).sort().forEach(key => {
			sortedAttributes[key] = selectedAttributes[key];
		});
		
		const signature = JSON.stringify(sortedAttributes);
		// console.log('Cart.js - Signature:', signature);
		
		if (window.variationMap && window.variationMap[signature]) {
			console.log('Cart.js - Found variation:', window.variationMap[signature]);
			return [window.variationMap[signature]];
		}
		
		console.log('Cart.js - No match found');
		return [];
	}


}

document.addEventListener('DOMContentLoaded', function() {
    const cartManager = new CartManager();
    
    cartManager.initShowPageVariations();
    
    window.CartManager = cartManager;
});

if (typeof module !== 'undefined' && module.exports) {
    module.exports = CartManager;
}
