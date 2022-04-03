@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- 1ページ目に遷移するボタン（1ページ目にいるときは非表示） --}}
        <?php if ($paginator->currentPage() > $paginator->onFirstPage()): ?>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">&laquo;</a>
            </li>
        <?php elseif ($paginator->currentPage() == $paginator->onFirstPage()): ?>
            <li class="page-item"></li>
        <?php endif; ?>

        {{-- 1つ前のページに遷移するボタン（1ページ目にいるときは非表示） --}}
        <?php if ($paginator->currentPage() > $paginator->onFirstPage()): ?>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
            </li>
        <?php elseif ($paginator->currentPage() == $paginator->onFirstPage()): ?>
            <li class="page-item"></li>
        <?php endif; ?>

        {{-- ページネーション要素 --}}
            {{-- 定数よりもページ数が多い時 --}}
            @if ($paginator->lastPage() > config('pagination.paginate_num'))

                {{-- 現在ページが表示するリンクの中心位置よりも左の時 --}}
                @if ($paginator->currentPage() <= floor(config('pagination.paginate_num') / 2))
                    <?php $start_page = 1; //最初のページ ?>
                    <?php $end_page = config('pagination.paginate_num'); ?>

                {{-- 現在ページが表示するリンクの中心位置よりも右の時 --}}
                @elseif ($paginator->currentPage() > $paginator->lastPage() - floor(config('pagination.paginate_num') / 2))
                    <?php $start_page = $paginator->lastPage() - (config('pagination.paginate_num') - 1); ?>
                    <?php $end_page = $paginator->lastPage(); ?>

                {{-- 現在ページが表示するリンクの中心位置の時 --}}
                @else
                    <?php $start_page = $paginator->currentPage() - (floor((config('pagination.paginate_num') % 2 == 0 ? config('pagination.paginate_num') - 1 : config('pagination.paginate_num'))  / 2)); ?>
                    <?php $end_page = $paginator->currentPage() + floor(config('pagination.paginate_num') / 2); ?>
                @endif

            {{-- 定数よりもページ数が少ない時 --}}
            @else
                <?php $start_page = 1; ?>
                <?php $end_page = $paginator->lastPage(); ?>
            @endif

            {{-- 処理部分 --}}
            @for ($i = $start_page; $i <= $end_page; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

        {{-- 次のページに遷移するボタン（最終ページ目にいるときは非表示） --}}
        <?php if ($paginator->currentPage() < $paginator->lastPage()): ?>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
            </li>
        <?php elseif ($paginator->currentPage() == $paginator->lastPage()): ?>
            <li class="page-item"></li>
        <?php endif; ?>

        {{-- 最終ページに遷移するボタン（最終ページ目にいるときは非表示） --}}
        <?php if ($paginator->currentPage() < $paginator->lastPage()): ?>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
            </li>
        <?php elseif ($paginator->currentPage() == $paginator->lastPage()): ?>
            <li class="page-item"></li>
        <?php endif; ?>
    </ul>
@endif
