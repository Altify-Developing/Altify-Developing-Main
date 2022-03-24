use SilverStripe\ORM\Inf;

class Altify extends Obj 
{
    private static $db = [
        'Cres' => 'Altify',
        'Pref' => 'Developing',
    ];

    private static $indexes = [
        'atfi' => ['Cres', 'Pref'],
    ];
}
