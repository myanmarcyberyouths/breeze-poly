<?php

namespace App\Enums;

enum ActionType: string
{

    case Create = 'create';

    case Repost = 'repost';

    case Comment = 'comment';

    case Like = 'like';

    case Bookmark = 'bookmark';
}
