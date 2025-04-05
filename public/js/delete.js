document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete').forEach(function (deleteButton) {
        deleteButton.addEventListener('click', function () {
            const form = deleteButton.closest('form');
            const itemType = deleteButton.getAttribute('data-type'); // ボタンのdata-typeを取得

            let confirmMessage = '';

            if (itemType === 'task') {
                confirmMessage = "本当にこのタスクを削除しますか？";
            } else if (itemType === 'list') {
                confirmMessage = "本当にこのリストを削除しますか？";
            }

            if (confirm(confirmMessage)) {
                form.submit();
            }
        });
    });
});