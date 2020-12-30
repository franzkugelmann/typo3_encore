<?php

declare(strict_types=1);

/*
 * This file is part of the "typo3_encore" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Ssch\Typo3Encore\ViewHelpers;

use Ssch\Typo3Encore\Integration\AssetRegistryInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class PreloadViewHelper extends AbstractViewHelper
{
    /**
     * @var AssetRegistryInterface
     */
    private $assetRegistry;

    public function __construct(AssetRegistryInterface $assetRegistry)
    {
        $this->assetRegistry = $assetRegistry;
    }

    public function initializeArguments(): void
    {
        $this->registerArgument('uri', 'string', 'The uri to preload', true);
        $this->registerArgument('as', 'string', 'The type like style or script', true);
        $this->registerArgument('attributes', 'array', 'The attributes of this link (e.g. "[\'as\' => true]", "[\'crossorigin\' => \'use-credentials\']")', false, []);
    }

    public function render(): void
    {
        $attributes = $this->arguments['attributes'] ?? [];
        $this->assetRegistry->registerFile($this->arguments['uri'], $this->arguments['as'], $attributes, 'preload');
    }
}
