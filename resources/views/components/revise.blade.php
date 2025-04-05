<div class="container-xl pt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header fw-bold">タスクを編集する</div>
                    <form method="post" action="{{ route('update_task',$task->id)}}">
                        @csrf
                            @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="task">タスク</label>
                                <input type="text" class="form-control border-success" name="task_name" id="taskInput" value="{{ $task->task }}" />
                                    @error('task_name')
                                        <div class="mt-3">
                                        <p>{{ $message}}</p>
                                        </div>
                                    @enderror
                                <label for="due_date" class="mt-2">日付指定</label>
                                    <input type="date" class="form-control border-success" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" />
                                <label for="list" class="mt-2">リスト設定</label>
                                    <select class="form-select border-success"name="list_id" aria-label="リストを選択">
                                        <option value="" selected>リストを選択</option>
                                            @foreach($userLists as $item)
                                        <option value=" {{ $item->id }}">{{ $item->list }}</option>
                                            @endforeach
                                    </select>
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
