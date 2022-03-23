<?php

namespace lil\Lib;

class Pagination
{
    public int $current_page; //صقحه کنونی
    public int $count_data;   //تعداد کل رکرد ها
    public int $count_page;   //تعداد کل خانه های که می خواهیم نمابش دهیم
    public int $count_row;    //تعداد سطر اطلاعات
    /**
     * __construct
     *
     * @param  mixed $max
     * @param  mixed $count
     * @param  mixed $current
     * @return void
     * 
     */
    public function __construct(array $data)
    {
        $this->current_page = $data['current_page'];
        $this->count_data = $data['count_data'];
        $this->count_page = $data['count_page'];
        $this->count_row = $data['count_row'];
    }

    //تعداد کل صفحات
    public function allPage()
    {
        return $this->count_data / $this->count_row;
    }
    //آیا صقحه رفتن به جلو نمایش داده شود
    public function isNext(): bool
    {
        if ($this->current_page > ($this->allPage() -  $this->count_page / 2)) {
            return false;
        }
        return true;
    }
    //آیا صقحه نمایش به عقب نمایش داده شود
    public function isPrev(): bool
    {
        if ($this->current_page > ($this->count_page / 2)) {
            return true;
        }

        return false;
    }
    //رفتن به جلو
    public function prev(): int
    {
        return $this->current_page - 1;
    }
    //رفتن به عقب
    public function next(): int
    {
        return $this->current_page + 1;
    }
    //آرایه ای از برگه ها
    public function pages(): array
    {
        $page = [];

        for ($i = $this->getStart(); $i < $this->getEnd(); $i++) {

            $page[] = $i + 1;
        }
        return $page;
    }
    public function getCurrentPage( )
    {
        return $this->current_page;
    }
    public function getStart()
    {
        
        $min = ($this->current_page - ($this->count_page / 2));
        if ($min < 1) {
            $min = 0;
        }
        if ($this->current_page > ($this->allPage() - $this->count_page / 2)) {
            $min = $this->allPage() - $this->count_page;
        }
        if ($this->allPage() < $this->count_page) {
            $min = 0;
        }
        return floor($min);
    }
    public function getEnd()
    {
        $max = $this->count_page;
        if ($this->current_page > ($this->count_page / 2)) {
            $max = ($this->current_page + ($this->count_page / 2));
        }
        if ($this->current_page > ($this->allPage() -  $this->count_page / 2)) {
            $max = $this->allPage();
        }
        return $max;
    }
}
