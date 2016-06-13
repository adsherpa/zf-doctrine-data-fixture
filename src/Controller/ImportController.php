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
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\Common\Persistence\ObjectManager;
use ZF\Doctrine\DataFixture\ServiceManager\ServiceManager as DataFixtureServiceManager;
use Doctrine\Common\DataFixtures\Loader;

class ImportController extends AbstractActionController
{
    protected $paths;

    protected $em;


    const PURGE_MODE_TRUNCATE = 2;

    public function __construct(DataFixtureServiceManager $dataFixtureManager)
    {
        $this->dataFixtureManager = $dataFixtureManager;
    }

    protected function configure()
    {
        parent::configure();

        $this->setName('data-fixture:import')
            ->setDescription('Import Data Fixtures')
            ->setHelp(
<<<EOT
The import command Imports data-fixtures
EOT
            )
            ->addOption('append', null, InputOption::VALUE_NONE, 'Append data to existing data.')
            ->addOption('purge-with-truncate', null, InputOption::VALUE_NONE, 'Truncate tables before inserting data');
    }

    public function importAction()
    {
        $loader = new Loader();
        $purger = new ORMPurger();

        foreach ($this->dataFixtureManager->getAll() as $fixture)
        {
            $loader->addFixture($fixture);
        }

#        if ($input->getOption('purge-with-truncate')) {
#            $purger->setPurgeMode(self::PURGE_MODE_TRUNCATE);
#        }

        $executor = new ORMExecutor($this->dataFixtureManager->getObjectManager(), $purger);
        $executor->execute($loader->getFixtures(), false) ; #$input->getOption('append'));
    }
}
