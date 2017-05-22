<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/4/13
 * Time: 11:35
 */

namespace App\libs\PHPWord;

use App\Http\Models\House_Safety_Identity_Report;

class TableUtils
{
    public static function getTable($data){
        $report = new House_Safety_Identity_Report();
        $rows = $report->queryAppraiseReportByReportNum($data);
        $row = null;
        if($rows!=null){
            $row = $rows[0];
        }
        // New Word Document
        $PHPWord = new \PHPWord();
        // New portrait section
        $section = $PHPWord->createSection();
        $section->addTextBreak(1);
        // Add text elements$document->setValue('Template', iconv('utf-8', 'GB2312//IGNORE', '中文'));
        $section->addText(iconv('utf-8', 'GB2312//IGNORE', '长沙市城市房屋安全鉴定报告'),array('bold'=>true, 'size'=>20),array('align'=>'center'));
        $section->addTextBreak(1);
        $title =  '长房鉴定字第'.$row->report_num .'号';
        //return $title;
        $section->addText(iconv('utf-8', 'GB2312//IGNORE', $title),array('size'=>12,'bold'=>true),array('align'=>'right'));
        $section->addTextBreak(1);

        $styleTable = array('borderColor'=>'black',
            'borderSize'=>5,
            'cellMargin'=>50);
        $styleFirstRow = array('bgColor'=>'66BBFF');
        $PHPWord->addTableStyle('myTable', $styleTable, $styleFirstRow);
        $table = $section->addTable('myTable');
        $table->addRow(500);
        $table->addCell(4600)->addText(iconv('utf-8', 'GB2312//IGNORE', '一、申请鉴定单位（人）：'),
            array('bold'=>true, 'size'=>12,'valign'=>'center'));
        $table->addCell(4600)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->applicant),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(4600)->addText(iconv('utf-8', 'GB2312//IGNORE', '二、房屋地址：'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(4600)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->address),
            array('size'=>12));

        $table->addRow(500);
        $table->addCell(4600)->addText(iconv('utf-8', 'GB2312//IGNORE', '三、房屋基本情况：'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(4600)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->house_basic_facts),
            array('size'=>12));

        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '区域'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->district),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '街道'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->street),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '房屋名称'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->house_name),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '建造年份'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', substr($row->build_end_year,0,10)),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '产权单位'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->owner_ship),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '联系电话'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->phone),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '使用单位'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->use_unit),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '结构类别'),
            array('bold'=>true, 'size'=>12));/*砖木_0","土砖_1","木_2"*/
        $structure = '';
        if($row->structure=='0'){$structure='砖木';}
        else if($row->structure=='1'){$structure='土砖';}
        else if($row->structure=='2'){$structure='木';}
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE',$structure ),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '使用性质'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->use_property),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '平面形式'),
            array('bold'=>true, 'size'=>12));
        $planeForm = '';/*0:行列式1:周边式2:点群式3:混合式*/
        if($row->plane_form=='0'){$planeForm='行列式';}
        else if($row->plane_form=='1'){$planeForm='周边式';}
        else if($row->plane_form=='2'){$planeForm='点群式';}
        else if($row->plane_form=='3'){$planeForm='混合式';}
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE',$planeForm ),
            array('size'=>12));

        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '房屋层数'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->layer_number),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '房屋用途'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->house_use),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '建筑面积'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->build_area),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '产权证号'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->certificate_num),
            array('size'=>12));

        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '使用年限'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->use_yesr),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '健康等级'),
            array('bold'=>true, 'size'=>12));
        $dangerLevel = '';/*A_0","B_1","C_2","D_3" */
        if($row->danger_level=='0'){$dangerLevel='A';}
        else if($row->danger_level=='1'){$dangerLevel='B';}
        else if($row->danger_level=='2'){$dangerLevel='C';}
        else if($row->danger_level=='3'){$dangerLevel='D';}
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $dangerLevel),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '鉴定单位'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->appraise_unit),
            array('size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '检测人员'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->inspector),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '物业单位'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(6900)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->property),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(2300)->addText(iconv('utf-8', 'GB2312//IGNORE', '四、鉴定目的'),
            array('bold'=>true, 'size'=>12));
        $table->addCell(6900)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->appraise_purpose),
            array('size'=>12));


        $table->addRow(500);
        $table->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE', '五、鉴定情况'),
            array('bold'=>true, 'size'=>12));
        $table->addRow(2000);
        $table->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE',$row->appraise_condition),
            array('size'=>12));

        $section->addPageBreak();
        // Add text elements$document->setValue('Template', iconv('utf-8', 'GB2312//IGNORE', '中文'));
        $section->addText(iconv('utf-8', 'GB2312//IGNORE', '长沙市城市房屋安全鉴定报告'),array('bold'=>true, 'size'=>20),array('align'=>'center'));
        $section->addTextBreak(1);
        $section->addText(iconv('utf-8', 'GB2312//IGNORE', $title),array('size'=>12,'bold'=>true),array('align'=>'right'));
        $section->addTextBreak(1);
        $PHPWord->addTableStyle('myTable2', $styleTable, $styleFirstRow);
        $table2 = $section->addTable('myTable2');

        $table2->addRow(500);
        $table2->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE', '六、损坏原因分析'),
            array('bold'=>true, 'size'=>12));
        $table2->addRow(2000);
        $table2->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE',$row->destroyed_reason),
            array('size'=>12));


        $table2->addRow(500);
        $table2->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE', '七、鉴定结论处理意见'),
            array('bold'=>true, 'size'=>12));
        $table2->addRow(2000);
        $table2->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE',$row->conclusion_handle),
            array('size'=>12));


        $table2->addRow(500);
        $table2->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE', '八、备注'),
            array('bold'=>true, 'size'=>12));
        $table2->addRow(2000);
        $table2->addCell(9200)->addText(iconv('utf-8', 'GB2312//IGNORE',$row->remark),
            array('size'=>12));


        $table2->addRow(500);
        $table2->addCell(3067)->addText(iconv('utf-8', 'GB2312//IGNORE', '区鉴定办公室人员'),
            array('bold'=>true, 'size'=>12));
        $table2->addCell(3067)->addText(iconv('utf-8', 'GB2312//IGNORE', '市鉴定办公室人员'),
            array('bold'=>true, 'size'=>12));
        $table2->addCell(3067)->addText(iconv('utf-8', 'GB2312//IGNORE', '市鉴定办公室负责人'),
            array('bold'=>true, 'size'=>12));


        $table2->addRow(2000);
        $table2->addCell(3067)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->district_appraise_staff),
            array( 'size'=>12));
        $table2->addCell(3067)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->city_appraise_staff),
            array('size'=>12));
        $table2->addCell(3067)->addText(iconv('utf-8', 'GB2312//IGNORE', $row->house_name),
            array('size'=>12));

        // Save File
        $objWriter = \PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save(base_path('public/uploads').'/report.docx');
    }
}