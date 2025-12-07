<?php

namespace Facade\Ignition\Middleware;

use Facade\FlareClient\Report;
<<<<<<< HEAD
=======
use ReflectionClass;
use Symfony\Component\Process\Exception\RuntimeException;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
use Symfony\Component\Process\Process;

class AddGitInformation
{
    public function handle(Report $report, $next)
    {
<<<<<<< HEAD
        $report->group('git', [
            'hash' => $this->hash(),
            'message' => $this->message(),
            'tag' => $this->tag(),
            'remote' => $this->remote(),
            'isDirty' => ! $this->isClean(),
        ]);
=======
        try {
            $report->group('git', [
                'hash' => $this->hash(),
                'message' => $this->message(),
                'tag' => $this->tag(),
                'remote' => $this->remote(),
            ]);
        } catch (RuntimeException $exception) {
        }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        return $next($report);
    }

    public function hash(): ?string
    {
        return $this->command("git log --pretty=format:'%H' -n 1");
    }

    public function message(): ?string
    {
        return $this->command("git log --pretty=format:'%s' -n 1");
    }

    public function tag(): ?string
    {
        return $this->command('git describe --tags --abbrev=0');
    }

    public function remote(): ?string
    {
        return $this->command('git config --get remote.origin.url');
    }

<<<<<<< HEAD
    public function isClean(): bool
    {
        return empty($this->command('git status -s'));
    }

    protected function command($command)
    {
        $process = (new \ReflectionClass(Process::class))->hasMethod('fromShellCommandline')
=======
    protected function command($command)
    {
        $process = (new ReflectionClass(Process::class))->hasMethod('fromShellCommandline')
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
            ? Process::fromShellCommandline($command, base_path())
            : new Process($command, base_path());

        $process->run();

        return trim($process->getOutput());
    }
}
