<?php
namespace wbb\data\post;
use wcf\data\bookmark\Bookmark;
use wcf\data\bookmark\BookmarkAction;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

/**
 * Executes bookmark-related actions for posts.
 * 
 * @author		2016-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.bookmark.wbb
 */
class PostBookmarkAction extends BookmarkAction {
	/**
	 * post
	 */
	public $post;
	public $alreadyBookmarked = 0;
	
	/**
	 * Validates parameters to display the 'add bookmark' form.
	 */
	public function validateGetAddBookmarkDialog() {
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
	public function getAddBookmarkDialog() {
		
		WCF::getTPL()->assign([
				'action' => 'add',
				'alreadyBookmarked' => $this->alreadyBookmarked,
				'isPrivate' => 0,		// = public
				'remark' => '',
				'title' => $this->post->getTitle(),
				'url' => $this->post->getLink()
		]);
		
		return [
				'template' => WCF::getTPL()->fetch('bookmarkDialog')
		];
	}
}
