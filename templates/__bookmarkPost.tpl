{if MODULE_BOOKMARK && $__wcf->user->userID && $__wcf->session->getPermission('user.bookmark.canUseBookmark')}
    <li class="jsAddBookmarkPostButton jsOnly" data-object-id="{@$post->postID}"><a href="#" title="{lang}wcf.bookmark.add{/lang}" class="button jsTooltip"><span class="icon icon16 fa-{BOOKMARK_DISPLAY_ICON}"></span> <span class="invisible">{lang}wcf.bookmark.add{/lang}</span></a></li>
{/if}
