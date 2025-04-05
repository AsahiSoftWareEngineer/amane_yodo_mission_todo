<div class="container-xl pt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header fw-bold">リストを編集する</div>
                    <form method="post" action="{{route('update_list_name',$currentList->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="list-name-edit">
                                <label for="list">リスト名</label>
                                <input type="text" class="form-control border-success" name="list_name" id="listInput" value="{{ $currentList->list }}" />
                                    @error('list_name')
                                        <div class="mt-3">
                                        <p>{{ $message}}</p>
                                        </div>
                                    @enderror
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success text-nowrap">完了</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
