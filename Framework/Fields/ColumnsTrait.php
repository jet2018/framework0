<?php

namespace Jet\Framework\Fields;

use Jet\Framework\Core\CoreDbError;

trait ColumnsTrait
{


    public function CharField($length=256, $unique = false, $null = false, $default=null): CharField
    {
        return new CharField($length=$length, $unique=$unique, $null=$null, $default=$default);
    }

    public function PositiveIntegerField($length=11, $unique = false, $null = true, $default=null, $increment=false): string
    {
        $table =new PositiveIntegerField($length, $unique, $null, $default, $increment);
        return $table->fieldStub();
    }


    public function IntegerField($length=11, $unique = false, $null = true, $increment=false, $default = null, $allow_positive_only=false): IntegerField
    {
        return new IntegerField($length=$length, $unique=$unique, $null= $null, $increment=$increment, $default=$default, $unsigned =$allow_positive_only);
    }

    public function BigIntegerField($length=null, $unique=false, $increment=false, $null=true, $default=null, $allow_positive_only=false): string
    {
        $table = new BigIntegerField($length, $unique, $increment, $null,  $unsigned=$allow_positive_only, $default);
        return $table->fieldStub();
    }
    /**
     * @throws CoreDbError
     */
    public function SmallIntegerField($length=null, $unique=false, $increment=false,  $default=null, $null=true, $allow_positive_only=false): string
    {
        $table = new SmallIntegerField($length, $unique, $increment, $null, $default, $unsigned=$allow_positive_only);
        return $table->fieldStub();
    }


    /**
     * @throws CoreDbError
     */
    public function TextField($length=null, $unique = false, $null = true, $default=null): string
    {
        $table = new TextField($length, $unique, $null, $default);
        return $table->fieldStub();
    }

    /**
     * @throws CoreDbError
     */
    public function JsonField($null=true): string
    {
        $table = new JsonField($null);
        return $table->fieldStub();
    }

    public function PrimaryKeyField($config): PrimaryKeyField
    {
        $this->setHasPk(true);
        return new PrimaryKeyField($config);
    }

    public function ImageField($upload_to=null, $config): ImageField
    {
        return new ImageField($config);
    }

    public function DocumentField($upload_to=null, $config): DocumentField
    {
        return new DocumentField($config);
    }

    public function FileField($upload_to=null, $config): FileField
    {
        return new FileField($config);
    }

    /**
     * @throws CoreDbError
     */
    public function ForeignKey($model=null, $on_delete=null, $null=false, $on_update=null): string
    {
        if (!$model){
            throw new CoreDbError("Foreign key must define the table it connects to. ");
        }else{
            $rel = new ForeignKey($model, $on_delete, $on_update, $null);
            return $rel->fieldStub();
        }
    }

}
