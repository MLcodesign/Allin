@if(isset($delete) && $delete)
<!-- delete -->
<div class="message-box animated fadeIn" id="message-box-delete">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-trash-o"></span> 刪除確認</div>
            <div class="mb-content">
                <p>您將刪除 {{ isset($item)? $item : 'Item' }}, 確定?</p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default pull-right mb-control-close">關閉</button>
                <button style="margin-right:5px;" class="btn btn-danger pull-right mb-control-action">刪除</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete -->
@endif