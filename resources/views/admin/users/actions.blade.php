<a href="{{ route('users.show' , $id) }}" class="btn btn-info">
    {{ __('common.show') }}
</a>
<a href="{{ route('users.edit' , $id) }}" class="btn btn-info">
    {{ __('common.edit') }}
</a>
<a onclick="deleteConfirmation({{$id}})" class="btn btn-danger">
    {{ __('common.destroy') }}
</a>
<form action="{{ route('users.destroy' , $id) }}" class="deleted_form_{{$id}}" method="post">
    @csrf
    @method('DELETE')
</form>
