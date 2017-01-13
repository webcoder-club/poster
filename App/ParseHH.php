<?php
namespace App;

use Sunra\PhpSimple\HtmlDomParser;

class ParseHH
{
    /**
     * ParseHH constructor.
     * @param int $id
     */
    function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Text\BaseAbstract[]
     */
    public function execute()
    {
        $link = 'https://hh.ru/vacancy/' . $this->id;
        $html = file_get_contents($link);
        $dom = HtmlDomParser::str_get_html($html);

        $vacancy = $dom->find('h1', 0);
        $salary = $dom->find('.l-content-colum-1 .l-paddings', 1);
        $town = $dom->find('.l-content-colum-2', 1);
        $exp = $dom->find('[itemprop=experienceRequirements]', 0);

        return [
            new Text\Vacancy($vacancy->text()),
            new Text\Salary($salary->text()),
            new Text\Town($town->text()),
            new Text\Experience($exp->text())
        ];
    }
}