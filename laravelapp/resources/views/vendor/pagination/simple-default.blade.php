{{--$paginator変数にあるメソッドを多く使っている。これはpaginateやsimplePaginateで返されたインスタンス--}}
@if ($paginator->hasPages())  {{--hasPages()は、複数のページがあるかどうかをチェック。あればtrue、なければfalse--}}
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage()) {{--onFirstPage()は、最初のページを表示しているかどうかッチェック。最初のページならtrue--}}
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li> {{--@langは、国際化対応のリソースからpagination.previousという名前の値を取り出している--}}
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages()) {{--hasMorePages()は、現在のページより先にページがあればtrue、なければfalse--}}
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li> {{--@langは、国際化対応のリソースからpagination.nextという名前の値を取り出している--}}
        @else
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
