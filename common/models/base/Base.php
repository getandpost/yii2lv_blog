<?php
namespace common\models\base;

/**
 * 基础模型
 */
use yii\db\ActiveRecord;

class Base extends ActiveRecord
{
    /**
     * 获取分页数据
     * @param unknown $query
     * @param number $curPage
     * @param number $pageSize
     * @param unknown $search
     * @return number[]|array[]|unknown
     */
    public function getPages($query, $curPage = 1, $pageSize = 10, $search = null)
    {
        if ($search) {
            $query = $query->andFilerWhere($search);
        }
        $data['count'] = $query->count();
        if (!$data['count']) {
            return [
                'count' => 0,
                'curPage' => $curPage,
                'pageSize' => $pageSize,
                'start' => 0,
                'end' => 0,
                'data' => []
            ];
        }
        
        // 超过实际页数，不取curPage为当前页
        $curPage = (ceil($data['count']/$pageSize)<$curPage)?ceil($data['count']/$pageSize):$curPage;
        $data['curPage'] = $curPage;
        $data['pageSize'] = $pageSize;
        $data['start'] = ($curPage-1)*$pageSize+1;
        $data['end'] = (ceil($data['count']/$pageSize) == $curPage)?$data['count']:($curPage-1)*$pageSize+$pageSize;
        $data['data'] = $query->offset(($curPage-1)*$pageSize)->limit($pageSize)->asArray()->all();
        
        return $data;
    }
}