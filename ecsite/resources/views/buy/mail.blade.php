<div>
  これは{{ config('app.name', 'Laravel') }}のテストメールです。
</div>
<div>
  この度はご購入ありがとうございます。
</div>
<div>
  入金が確認されました。
</div>
<div>
  <div class="card">
    @foreach ($cartitems as $cartitem)
      <div class="card-header">
        {{ $cartitem->item->name }}
      </div>
      <div class="card-body">
        <div>
          {{ $cartitem->item->amount }}円
        </div>
        <div>
          {{ $cartitem->quantity }}個
        </div>
      </div>
    @endforeach
  </div>
</div>
<div class="card">
  <div class="card-header">
    小計
  </div>
  <div class="card-body">
    <div>
      {{ $subtotal }}円
    </div>
  </div>
</div>