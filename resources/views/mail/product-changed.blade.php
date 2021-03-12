<h3 style="margin-bottom: 20px; color: #b21f2d"> Продукт "{{ $product->title }}" был {{$action}}! </h3>
<p>Здравствуйте, уважаемый пользователь!</p>
<p> Продукт #{{$product->id}} {{ $product->title }} был {{ $action }} в {{ $product->updated_at }}.</p>
<h4>Данные продукта:</h4>
<ul>
    @foreach($product->toArray() as $key=>$value)
        <li><strong>{{$key}}</strong> : {{$value}}</li>
    @endforeach
</ul>
<p><strong>С уважением, Laravel</strong></p>