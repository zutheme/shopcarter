<!-- .product tab -->
<div class="product-tabs product-tabs--sticky">
   <div class="product-tabs__list">
      <div class="product-tabs__list-body">
         <div class="product-tabs__list-container container">
            <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Description</a>
            <a href="#tab-specification" class="product-tabs__item">Specification</a>
            <a href="#tab-reviews" class="product-tabs__item">Reviews</a>
         </div>
      </div>
   </div>
   <div class="product-tabs__content">
      <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
         <div class="typography">
            <h3>Product Full Description</h3>
               <p></p>
         </div>
      </div>
      <div class="product-tabs__pane" id="tab-specification">
         <div class="spec">
            <h3 class="spec__header">Specification</h3>
         </div>
      </div>
      <div class="product-tabs__pane" id="tab-reviews">
         <div class="reviews-view">
            <div class="reviews-view__list">
               <h3 class="reviews-view__header">Customer Reviews</h3>
               <div class="reviews-list">
                  <ol class="reviews-list__content">
                     <li class="reviews-list__item">
                        <div class="review">
                           <div class="review__avatar">
                              <img src="images\avatars\avatar-1.jpg" alt="">
                           </div>
                           <div class="review__content">
                              <div class="review__author">Samantha Smith</div>
                                 <div class="review__rating">
                                    <div class="rating">
                                       <div class="rating__body">

                                       </div>
                                    </div>
                                 </div>
                              <div class="review__text">Phasellus id mattis nulla. Mauris velit nisi, imperdiet vitae sodales in, maximus ut lectus. Vivamus commodo scelerisque lacus, at porttitor dui iaculis id. Curabitur imperdiet ultrices fermentum.</div>
                              <div class="review__date">27 May, 2018</div>
                           </div>
                        </div>
                     </li>
                  </ol>
                  <div class="reviews-list__pagination">
                     <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link page-link--with-arrow" href="" aria-label="Previous"></a></li>
                        <li class="page-item"><a class="page-link" href="">1</a></li>
                        <li class="page-item active"><a class="page-link" href="">2 <span class="sr-only">(current)</span></a></li>
                        <li class="page-item"><a class="page-link" href="">3</a></li>
                        <li class="page-item"><a class="page-link page-link--with-arrow" href="" aria-label="Next"></a></li>
                     </ul>
                  </div>
               </div>
            </div>
               <form class="reviews-view__form">
                  <h3 class="reviews-view__header">Write A Review</h3>
                  <div class="row">
                     <div class="col-12 col-lg-9 col-xl-8">
                        <div class="form-row">
                           <div class="form-group col-md-4">
                              <label for="review-stars">Review Stars</label>
                               <select id="review-stars" class="form-control">
                                 <option>5 Stars Rating</option>
                                 <option>4 Stars Rating</option>
                                 <option>3 Stars Rating</option>
                                 <option>2 Stars Rating</option>
                                 <option>1 Stars Rating</option>
                               </select>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="review-author">Your Name</label>
                              <input type="text" class="form-control" id="review-author" placeholder="Your Name">
                           </div>
                           <div class="form-group col-md-4">
                              <label for="review-email">Email Address</label>
                              <input type="text" class="form-control" id="review-email" placeholder="Email Address">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="review-text">Your Review</label>
                           <textarea class="form-control" id="review-text" rows="6"></textarea>
                        </div>
                        <div class="form-group mb-0">
                           <button type="submit" class="btn btn-primary btn-lg">Post Your Review</button>
                        </div>
                     </div>
                  </div>
               </form>
         </div>
      </div>
   </div>
</div>
<!-- .product tab end -->