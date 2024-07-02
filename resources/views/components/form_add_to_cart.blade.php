@props(['product'])

<form method="POST" action="{{ route('add_to_cart') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="name" value="{{ $product->name }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    <input type="hidden" name="sale_price" value="{{ $product->sale_price }}">
    <input type="hidden" name="image" value="{{ $product->image }}">
    <input type="hidden" name="quantity" value="1">
    <input type="submit" value="Add to Cart" class="btn">
</form>