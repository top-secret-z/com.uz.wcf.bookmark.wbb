{if MODULE_BOOKMARK && $__wcf->user->userID && $__wcf->session->getPermission('user.bookmark.canUseBookmark')}
    <script data-relocate="true">
        require(['UZ/Bookmark/Wbb/Add'], function (UZBookmarkWbbAdd) {
            new UZBookmarkWbbAdd('forum', '', '', '.jsAddBookmarkPostButton');
        });
    </script>
{/if}
