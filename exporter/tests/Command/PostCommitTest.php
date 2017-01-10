<?php

namespace PdoGit\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

// http://symfony.com/doc/current/console.html#testing-commands
class PostCommitMockedTest extends\PHPUnit_Framework_TestCase 
{

  public function testExecute()
  {
    $ddo = $this->getMockBuilder('\PdoGit\DeepDiffObject')
                 ->disableOriginalConstructor() 
                 ->getMock();
    $ddo->differences = [
    ];

    $factory = $this->getMockBuilder('\PdoGit\Factory')
                 ->disableOriginalConstructor() 
                 ->getMock();
    $factory->method('deepDiff')
        ->willReturn($ddo);

    $application = new Application();
    $application->add(new PostCommit($factory));

    $command = $application->find('post-commit');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
        'command'  => $command->getName()
    ));

    // the output of the command in the console
    //$output = $commandTester->getDisplay();
    //$this->assertContains('Username: Wouter', $output);
  }

}
