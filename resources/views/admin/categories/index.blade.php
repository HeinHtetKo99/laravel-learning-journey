@extends('admin.layouts.app')

@section('title','Categories')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css">
    <style>
    </style>

@section('header','Categories')
@section('content')
    <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i>
        Create Category
    </a>
    <table id="table" class="display">
        <thead>
        <tr>
                <th class="text-center">Actions</th>
                <th class="text-center">Category Name</th>
                <th class="text-center">Description</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td class="text-center">
                        <a href="{{ url('/admin/categories/' . $item->id) }}" class="btn btn-info">
                            <i class="bi bi-eye-fill me-1"></i>
                            Show
                        </a>    
                        <a href="{{ url('/admin/categories/'.$item->id.'/edit') }}" class="btn btn-primary">
                            <i class="bi bi-pencil-fill me-1"></i>
                            Edit
                        </a>
                        <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}">
                            <i class="bi bi-trash-fill me-1"></i>
                            Delete
                        </button>
                    </td>
                    <td class="text-center">{{$item->category_name}}</td>
                    <td class="text-center">{{$item->description}}</td>
                    <td class="text-center">{{$item->created_at}}</td>
                    <td class="text-center">{{$item->updated_at}}</td>
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
                        destroy(id);
                        row.remove();

                        Swal.fire({
                        title: "Deleted!",
                        text: "You user has been deleted.",
                        icon: "success"
                        });
                    }
                    });
                })
                
                function destroy(id){
                    $.ajax({
                        url: '/admin/categories/'+id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                    })
                }
            })
        </script>
@endsection