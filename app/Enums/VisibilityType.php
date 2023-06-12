<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class VisibilityType extends Enum
{
    const Public = 'public';
    const Private = 'private';
    const Unlisted = 'unlisted';
}
