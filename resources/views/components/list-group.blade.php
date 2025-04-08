<div class="container-xl mt-4">
    @if($tasks->isEmpty())
        <h5>リスト別タスク一覧</h5>
            <div class="pt-2">
                <div class="alert alert-success" role="alert">現在、リストを設定しているタスクはありません。</div>
            </div>
    @endif

    @if(!($tasks->isEmpty()))
    <table class="table mt-2">
        <thead>
            <tr>
                <th>リスト別タスク一覧</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks->groupBy('list_id') as $listId => $taskGroup)
                <tr>
                    <th>
                    @if($taskGroup->isNotEmpty())
                    <span class="badge text-bg-success">{{ $taskGroup->first()->taskList->list }}</span>
                    @endif
                    </th>
                </tr>
            @foreach($taskGroup as $item)
                <tr class="task-item">
                    <td class="d-flex align-items-center justify-content-between"id="task-{{ $item->id }}">
                        <div class="d-flex align-items-center">
                            <div class="flex-column d-flex">
                                <form method="post" action="{{ route('sort_task', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-light btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                            <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                        </svg>
                                        <input type="hidden" name="cmd" value="up">
                                        <input type="hidden" name="list_id" value="{{ request()->get('list_id') }}">
                                    </button>
                                </form>
                                <form method="post" action="{{ route('sort_task', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-light btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                        </svg>
                                        <input type="hidden" name="cmd" value="down">
                                        <input type="hidden" name="list_id" value="{{ request()->get('list_id') }}">
                                    </button>
                                </form>
                            </div>
                            <div class="task ms-2" id="text-{{ $item->id }}">{{ $item->task }}</div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            
                            <div class="task-check">
                                <form method="post" action="{{ route('renew_checkbox', $item->id) }}" id="checked-form-{{ $item->id }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                                        </svg>
                                        <input class="task-checkbox" type="hidden" id="checkbox-{{ $item->id }}" name="checked" {{ $item->checked ? 'checked' : '' }}>
                                    </button>
                                </form>
                            </div>

                            <div class="task-edit">
                                <a href="{{ route('edit_task', $item->id) }}">
                                    <button type="button" class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                        </svg>
                                    </button>
                                </a>
                            </div>

                            <div class="task-delete">
                                <form method="post" action="{{ route('destroy_task', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger delete" id="delete-{{ $item->id }}" data-type="task">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    @endif
</div>