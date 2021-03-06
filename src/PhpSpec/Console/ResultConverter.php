<?php

/*
 * This file is part of PhpSpec, A php toolset to drive emergent
 * design by specification.
 *
 * (c) Marcello Duarte <marcello.duarte@gmail.com>
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpSpec\Console;

use PhpSpec\Event\ExampleEvent;

/**
 * Class ResultConverter converts Example result into exit code
 */
class ResultConverter
{
    /**
     * @var IO
     */
    private $io;

    /**
     * ResultConverter constructor.
     *
     * @param IO $io
     */
    public function __construct(IO $io)
    {
        $this->io = $io;
    }

    /**
     * Convert Example result into exit code
     *
     * @param mixed $result
     *
     * @return 0|1
     */
    public function convert($result)
    {
        switch ($result) {
            case ExampleEvent::PASSED:
            case ExampleEvent::SKIPPED:
                return 0;

            case ExampleEvent::PENDING:
                if ($this->io->isIgnorePendingEnabled()) {
                    return 0;
                }
                break;
        }

        return 1;
    }
}
