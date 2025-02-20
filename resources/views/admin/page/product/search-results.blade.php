@foreach($products as $key => $product)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $product->code ?? '' }}</td>
        <td>{{ $product->name ?? '' }}</td>
        <td>{{ $product->category->name ?? ''}}</td>
        <td>{{ number_format($product->price) ?? 0}} VNĐ</td>
        <td>
            <img src="{{ $product->detail_image ?? '' }}" alt="{{ $product->name }}" width="100">
        </td>
        <td class="text-center">
            <a href="{{ route('customer.showProductDetail', $product->id) }}"
               class="btn btn-sm btn-secondary">
                <i class="fas fa-eye"></i>
            </a>
            <a href="#"
               class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{route("admin.product.getDelete", $product->id)}}"
               class="btn btn-sm btn-danger" onClick = 'return confirm("Bạn có chắc chắn muốn xoá không?")'>
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
