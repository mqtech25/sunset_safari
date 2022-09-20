<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Ecommerce Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="wishlist-items-limit">Wishtlist items limit</label>
                <input
                    class="form-control"
                    type="number"
                    placeholder="Enter limit for wishlist items"
                    id="wishlist-items-limit"
                    name="wishlist-items-limit"
                    value="{{ config('settings.wishlist-items-limit') }}"
                />
            </div>
            <label for="image-settings"><strong>Images Settings</strong></label>
            <div class="form-row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="control-label" for="cat_img_width">Category/Home Image Width (px)</label>
                        <input
                            class="form-control"
                            type="number"
                            placeholder="Enter category thumb size"
                            id="cat_img_width"
                            name="cat_img_width"
                            value="{{ config('settings.cat_img_width') }}"
                        />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="control-label" for="product_image_width">Product Image Width (px)</label>
                        <input
                            class="form-control"
                            type="number"
                            placeholder="Enter product page image size"
                            id="product_image_width"
                            name="product_image_width"
                            value="{{ config('settings.product_image_width') }}"
                        />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="control-label" for="product_thumb_img">Product Thumbnail Width (px)</label>
                        <input
                            class="form-control"
                            type="number"
                            placeholder="Enter product thumb size"
                            id="product_thumb_img"
                            name="product_thumb_img"
                            value="{{ config('settings.product_thumb_img') }}"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>