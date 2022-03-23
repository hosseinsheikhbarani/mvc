<?php

namespace lil\Lib;

/**
 * UploadFile
 */
class UploadFile
{
    public $errors = [];
    public $file;


    /**
     * __construct
     *
     * @param  mixed $dir
     * @param  mixed $input
     * @param  mixed $extension
     * @param  mixed $size
     * @return void
     */
    public function __construct(string $dir, string $input, array $extension, int $size)
    {
        $this->extension = $extension;
        $dir = ROOTDIR . '/' . $dir . '/';

        if ($this->checkIsset($input)) {

            $this->file['name'] = $_FILES[$input]['name'];
            $this->file['size'] = $_FILES[$input]['size'];
            $this->file['tmp'] = $_FILES[$input]['tmp_name'];
            $this->file['type'] = $_FILES[$input]['type'];
            $this->extensions($extension);
            $this->fileSize($size);
            $this->seve($dir);
        }
    }
    public function getExtension()
    {
        return strtolower(pathinfo($this->file['name'], PATHINFO_EXTENSION));
    }
    public function getCustomName()
    {
        return rand();
    }
    public function extensions($extension)
    {
        if (in_array($this->getExtension(), $extension, true) === false) {
            $this->errors[] = ['er' => 'file', 'msg' => 'فرمت فایل صحیح نیست'];
            return false;
        }
        return true;
    }
    public function checkIsset($input)
    {
        if (!isset($_FILES[$input]) || $_FILES[$input]['error'] == UPLOAD_ERR_NO_FILE) {
            $this->errors[] = ['er' => 'file', 'msg' => 'فایل انتخاب نشد'];
            return false;
        }
        return true;
    }
    public function fileSize($size)
    {
        $size = $size * 1024 * 1024; //MB
        if ($this->file['size'] > $size) {
            $this->errors[] = ['er' => 'file', 'msg' => 'فایل بزرگتر از حد مجاز است'];
        }
    }
    public function seve($dir)
    {
        $name = $this->getCustomName() . '.' . $this->getExtension();
        if (empty($this->errors) == true) {
            move_uploaded_file($this->file['tmp'], $dir . $name);
            $this->errors[] = [
                'er' => 'ok',
                'msg' => 'فایل با موفقیت آپلود شد',
                'name' => $name
            ];
        }
        return $this->errors;
    }
}
