<!-- .product__sidebar -->
<div class="product__sidebar">
   <div class="product__availability">Availability: <span class="text-success">In Stock</span></div>
   <div class="product__prices">$1,499.00</div>
   <!-- .product__options -->
   <form class="product__options">
      <div class="form-group product__option">
         <label class="product__option-label">Color</label>
         <div class="input-radio-color">
            <div class="input-radio-color__list">
               <label class="input-radio-color__item input-radio-color__item--white" style="color: #fff;" data-toggle="tooltip" title="White"><input type="radio" name="color"><span></span></label>
               <label class="input-radio-color__item" style="color: #ffd333;" data-toggle="tooltip" title="Yellow"><input type="radio" name="color"><span></span></label>
               <label class="input-radio-color__item" style="color: #ff4040;" data-toggle="tooltip" title="Red"><input type="radio" name="color"><span></span></label>
               <label class="input-radio-color__item input-radio-color__item--disabled" style="color: #4080ff;" data-toggle="tooltip" title="Blue"><input type="radio" name="color" disabled="disabled"><span></span></label>
            </div>
         </div>
      </div>
      <div class="form-group product__option">
         <label class="product__option-label">Material</label>
         <div class="input-radio-label">
            <div class="input-radio-label__list">
               <label><input type="radio" name="material"><span>Metal</span></label>
               <label><input type="radio" name="material"><span>Wood</span></label>
               <label><input type="radio" name="material" disabled="disabled"><span>Plastic</span></label>
            </div>
         </div>
      </div>
      <div class="form-group product__option">
      <label class="product__option-label" for="product-quantity">Quantity</label>
         <div class="product__actions">
            <div class="product__actions-item">
               <div class="input-number product__quantity">
                  <input id="product-quantity" class="input-number__input form-control form-control-lg" type="number" min="1" value="1">
                  <div class="input-number__add"></div>
                  <div class="input-number__sub"></div>
               </div>
            </div>
            <div class="product__actions-item product__actions-item--addtocart">
               <button class="btn btn-primary btn-lg">Add to cart</button>
            </div>
            <div class="product__actions-item product__actions-item--wishlist">
               <button type="button" class="btn btn-secondary btn-svg-icon btn-lg" data-toggle="tooltip" title="Wishlist"><svg width="16px" height="16px"><use xlink:href="images/sprite.svg#wishlist-16"></use></svg></button>
            </div>
            <div class="product__actions-item product__actions-item--compare">
               <button type="button" class="btn btn-secondary btn-svg-icon btn-lg" data-toggle="tooltip" title="Compare"><svg width="16px" height="16px"><use xlink:href="images/sprite.svg#compare-16"></use></svg></button>
            </div>
         </div>
      </div>
   </form>
   <!-- .product__options / end -->
</div>
<!-- .product__end -->