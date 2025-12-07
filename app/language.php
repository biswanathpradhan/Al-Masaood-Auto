<<<<<<< HEAD
<?php

namespace JoeDixon\Translation;

use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    protected $guarded = [];
    protected $table = 'languages';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('translation.database.connection');
        $this->table = config('translation.database.languages_table');
    }

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
=======
<?php

namespace JoeDixon\Translation;

use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    protected $guarded = [];
    protected $table = 'languages';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('translation.database.connection');
        $this->table = config('translation.database.languages_table');
    }

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
