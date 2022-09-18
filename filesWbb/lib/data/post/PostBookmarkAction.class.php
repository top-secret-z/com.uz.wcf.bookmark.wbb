<?php

/*
 * Copyright by Udo Zaydowicz.
 * Modified by SoftCreatR.dev.
 *
 * License: http://opensource.org/licenses/lgpl-license.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
namespace wbb\data\post;

use wcf\data\bookmark\Bookmark;
use wcf\data\bookmark\BookmarkAction;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

/**
 * Executes bookmark-related actions for posts.
 */
class PostBookmarkAction extends BookmarkAction
{
    /**
     * post
     */
    public $post;

    public $alreadyBookmarked = 0;

    /**
     * Validates parameters to display the 'add bookmark' form.
     */
    public function validateGetAddBookmarkDialog()
    {
        $this->post = new Post($this->parameters['postID']);
        if (!$this->post->postID) {
            throw new IllegalLinkException();
        }

        if (Bookmark::checkExist('forum', $this->post->postID)) {
            $this->alreadyBookmarked = 1;
        }
    }

    /**
     * Gets the 'add bookmark' dialog.
     */
    public function getAddBookmarkDialog()
    {
        WCF::getTPL()->assign([
            'action' => 'add',
            'alreadyBookmarked' => $this->alreadyBookmarked,
            'isPrivate' => 0,        // = public
            'remark' => '',
            'title' => $this->post->getTitle(),
            'url' => $this->post->getLink(),
        ]);

        return [
            'template' => WCF::getTPL()->fetch('bookmarkDialog'),
        ];
    }
}
