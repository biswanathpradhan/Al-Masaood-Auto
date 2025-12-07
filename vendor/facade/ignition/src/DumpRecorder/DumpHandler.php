<?php

namespace Facade\Ignition\DumpRecorder;

use Symfony\Component\VarDumper\Cloner\VarCloner;

class DumpHandler
{
    /** @var \Facade\Ignition\DumpRecorder\DumpRecorder */
    protected $dumpRecorder;

    public function __construct(DumpRecorder $dumpRecorder)
    {
        $this->dumpRecorder = $dumpRecorder;
    }

    public function dump($value)
    {
<<<<<<< HEAD
        $data = (new VarCloner)->cloneVar($value);
=======
        $data = (new VarCloner())->cloneVar($value);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

        $this->dumpRecorder->record($data);
    }
}
