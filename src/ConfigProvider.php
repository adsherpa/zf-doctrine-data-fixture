<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://apiskeletons.org>.
 */

namespace ZF\Doctrine\DataFixture;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'controllers' => $this->getControllerDependencyConfig(),
            'console' => [
                'route' => $this->getConsoleRouterConfig(),
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories' => [
                DataFixtureManager::class => DataFixtureManagerFactory::class,
            ],
        ];
    }

    public function getControllerDependencyConfig()
    {
        return [
            'factories' => [
                Controller\HelpController::class =>
                    Controller\HelpControllerFactory::class,
                Controller\ImportController::class =>
                    Controller\ImportControllerFactory::class,
                Controller\ListController::class =>
                    Controller\ListControllerFactory::class,
            ],
        ];
    }

    public function getConsoleRouterConfig()
    {
        return [
            'routes' => [
                'zf-doctrine-data-fixture-help' => [
                    'options' => [
                        'route'    => 'data-fixture:help',
                        'defaults' => [
                            'controller' => Controller\HelpController::class,
                            'action'     => 'help'
                        ],
                    ],
                ],

                'zf-doctrine-data-fixture-import' => [
                    'options' => [
                        'route'    => 'data-fixture:import '
                            . '<fixture-group> [--append] [--do-not-append] [--purge-with-truncate]',
                        'defaults' => [
                            'controller' => Controller\ImportController::class,
                            'action'     => 'import'
                        ],
                    ],
                ],

                'zf-doctrine-data-fixture-list' => [
                    'options' => [
                        'route'    => 'data-fixture:list [<fixture-group>]',
                        'defaults' => [
                            'controller' => Controller\ListController::class,
                            'action'     => 'list'
                        ],
                    ],
                ],
            ],
        ];
    }
}
