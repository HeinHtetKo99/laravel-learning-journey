@extends('admin.layouts.app')

@section('title','Orders')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css">
    <style>
    </style>

@section('header','Orders')
@section('content')
    <a href="{{ url('/admin/orders/create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i>
        Create Order
    </a>
    <table id="table" class="display">
        <thead>
        <tr>
                <th class="text-center">Actions</th>
                <th class="text-center">Order Date</th>
                <th class="text-center">Total Price</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td class="text-center">
                        <a href="{{ url('/admin/orders/' . $item->id) }}" class="btn btn-info">
                            <i class="bi bi-eye-fill me-1"></i>
                            Show
                        </a>
                        <a href="{{ url('/admin/orders/'.$item->id.'/edit') }}" class="btn btn-primary">
                            <i class="bi bi-pencil-fill me-1"></i>
                            Edit
                        </a>
                        <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}">
                            <i class="bi bi-trash-fill me-1"></i>
                            Delete
                        </button>
                    </td>
                    <td class="text-center">{{ $item->order_date }}</td>
                    <td class="text-center">{{ $item->total_price }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                    <td class="text-center">{{ $item->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
        <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
        <script>
            $(document).ready(()=>{
                new DataTable('#table');
                const message = "{{ session()->has('message') ? session()->get('message') : '' }}";
                if(message){
                    myToast(message);
                }
                $(document).on('click','.btn-delete',(e)=>{
                    const row = $(e.currentTarget).closest('tr');
                    const id = $(e.currentTarget).data('id');
                    Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            destroy(id)
                                .done((response) => {
                                    row.remove();
                                    if (response && response.message) {
                                        myToast(response.message);
                                    }

                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Order deleted successfully.",
                                        icon: "success"
                                    });
                                })
                                .fail(() => {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Delete failed.",
                                        icon: "error"
                                    });
                                });
                        }
                    });
                })

                function destroy(id){
                    return $.ajax({
                        url: '/admin/orders/'+id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                    })
                }
            })
        </script>
@endsection

