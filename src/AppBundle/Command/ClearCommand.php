<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Command;

use FOS\OAuthServerBundle\Model\AuthCodeManagerInterface;
use FOS\OAuthServerBundle\Model\TokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ClearCommand
 * @package AppBundle\Command
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ClearCommand extends ContainerAwareCommand
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('app:oauth:clean')
            ->setDescription('Clean expired tokens');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $services = array(
            'fos_oauth_server.access_token_manager' => 'Access token',
            'fos_oauth_server.refresh_token_manager' => 'Refresh token',
            'fos_oauth_server.auth_code_manager' => 'Auth code',
        );

        foreach ($services as $service => $name) {
            /** @var $instance TokenManagerInterface */
            $instance = $this->getContainer()->get($service);
            if ($instance instanceof TokenManagerInterface || $instance instanceof AuthCodeManagerInterface) {
                $result = $instance->deleteExpired();
                $output->writeln(sprintf('Removed <info>%d</info> items from <comment>%s</comment> storage.', $result, $name));
            }
        }
    }
}
