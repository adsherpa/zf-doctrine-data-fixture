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
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use ZF\Doctrine\DataFixture\DataFixtureManager;
use Doctrine\Common\DataFixtures\Loader;
use Zend\Console\Adapter\Posix;
use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\ColorInterface as Color;
use RuntimeException;

class ListController extends AbstractActionController
{
    protected $config;
    protected $console;
    protected $dataFixtureManager;

    public function __construct(array $config, Posix $console, DataFixtureManager $dataFixtureManager = null)
    {
        $this->config = $config;
        $this->console = $console;
        $this->dataFixtureManager = $dataFixtureManager;
    }

    public function listAction()
    {
        if (! $this->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console.');
        }

        if ($this->dataFixtureManager) {
            $this->console->write(
                $this->params()->fromRoute('object-manager')
                . " " . $this->params()->fromRoute('fixture-group')
                . " Fixtures\n", Color::GREEN
            );

            foreach($this->dataFixtureManager->getAll() as $fixture) {
                $this->console->write(get_class($fixture) . "\n", Color::CYAN);
            }
        } else if ($this->params()->fromRoute('object-manager')) {
            $this->console->write($this->params()->fromRoute('object-manager') . " groups\n", Color::GREEN);

            foreach ($this->config[$this->params()->fromRoute('object-manager')] as $group => $smConfig) {
                $this->console->write("$group\n", Color::CYAN);
            }
        } else {
            $this->console->write("All object managers and groups\n", Color::GREEN);

            foreach ($this->config as $objectManagerAlias => $groupConfig) {
                $this->console->write("$objectManagerAlias\n", Color::YELLOW);

                foreach ($groupConfig as $group => $smConfig) {
                    $this->console->write("$group\n", Color::CYAN);
                }
            }
        }
    }
}
