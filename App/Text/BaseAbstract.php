<?php
namespace App\Text;

abstract class BaseAbstract
{
    protected $image;
    protected $text = '';

    protected $size = 40;
    protected $angle = 0;
    protected $x;
    protected $y;

    protected $color;
    protected $font = 'fonts/Roboto/Light.ttf';

    public function __construct(string $text)
    {
        $this->setText($text);
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setY(int $y)
    {
        $this->y = $y;
    }

    /**
     * @return array
     */
    public function getCenter()
    {
        $image_width = imagesx($this->image);
        $image_height = imagesy($this->image);

        // Get Bounding Box Size
        $text_box = imagettfbbox($this->size, $this->angle, $this->font, $this->text);
        // Get your Text Width and Height
        $text_width = $text_box[2] - $text_box[0];
        $text_height = $text_box[7] - $text_box[1];
        // Calculate coordinates of the text
        $x = ($image_width / 2) - ($text_width / 2);
        $y = ($image_height / 2) - ($text_height / 2);
        return [$x, $y];
    }

    /**
     * @return int
     */
    public function getCenterX()
    {
        return $this->getCenter()[0];
    }

    function write()
    {
        $this->color = imagecolorallocate($this->image, 255, 255, 255);
        imagettftext($this->image, $this->size, $this->angle, $this->getCenterX(), $this->y, $this->color, $this->font, $this->text);
    }
}