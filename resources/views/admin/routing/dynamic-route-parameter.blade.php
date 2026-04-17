@extends('admin.layouts.app')

@section('title','Dynamic Route Parameter')

@section('style')

@section('header','Dynamic Route Parameter')

@section('content')
    <form action="{{ url('admin/routing/dynamic-route-parameter') }}" method="post">
        @csrf()
        <div class="form-group">
            <label class="py-2">Text Color</label>
            <input type="text" class="form-control" name="text-color" placeholder="Enter text color" required>
        </div>
        <div class="form-group">
            <label class="py-2">Box Color</label>
            <input type="text" class="form-control" name="box-color" placeholder="Enter box color" required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary mt-3" id="submit">Submit</button>
        </div>
    </form>
@endsection

@section('script')
        <script>
        //    $(document).ready(()=>{
        //         $('#submit').click(()=>{
        //             const textColor = $('#text-color').val();
        //             const boxColor = $('#box-color').val();
        //             window.location.href = `http://127.0.0.1:8000/admin/routing/route-parameter/${textColor}/${boxColor}`
        //         })
        //    })
        </script>
@endsection