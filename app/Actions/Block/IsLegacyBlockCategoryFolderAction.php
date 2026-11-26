<?php

declare(strict_types=1);

namespace Themes\Civic\Actions\Block;

use Spatie\QueueableAction\QueueableAction;
use Themes\Civic\Datas\BlockCategoryRegistryData;

final class IsLegacyBlockCategoryFolderAction
{
    use QueueableAction;

    public function execute(string $folder): bool
    {
        return in_array($folder, BlockCategoryRegistryData::LEGACY_FOLDERS, true);
    }
}
