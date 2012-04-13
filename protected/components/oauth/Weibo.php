<?php
class Weibo extends Oauth
{
    protected $_api_type = 'weibo';

    /**
     * 同步发微博
     *
     * @code php
     * $tokens = array(
     *     0 => array(
     *         'platform' => 'sina',
     *         'token' => 'xxx',
     *         'token_secret' => 'ooo',
     *     ),
     *     // ....
     * );
     * @endcode
     *
     * @param string $status
     * @param string $pic
     * @param array $tokens
     * @return array
     */
    public function update($status, $pic = array(), $tokens = array())
    {
        if (empty($tokens))
        {
            return array();
        }

        $response = array();
        foreach ($tokens as $key => $token)
        {
            $platform = strtolower($token['platform']);
            $apiname = empty($pic['path']) ? 'statusesupdate' : 'statusesupload';
            $api = $this->api($apiname, $platform)->authRedirect(false);
            $data = array(
                'status' => $status,
                'pic' => isset($pic['path']) ? $pic['path'] : '',
                'data' => (isset($pic['path']) && isset($pic['data'])) ? $pic['data'] : null,
            );
            $response[$key] = $api->request($data, $token);
            $response[$key]['platform'] = $platform;
        }

        return $response;
    }

    /**
     * 根据token 或用户 id 获取相关微博 timeline
     *
     * @param array $params 每页数量页数等参数
     * @param array $token access token 信息, 包含 platform
     * @return array
     */
    public function timeline($params, $token = array())
    {
        $platform = strtolower($token['platform']);
        $defaults = array(
            'count' => 20,
            'page' => ($platform == 'qq') ? 0 : 1,
            'since_id' => 0,
            'max_id' => 0,
        );
        $params = array_merge($defaults, $params);

        $response = array();
        $api = $this->api('statusesusertimeline', $platform)->authRedirect(false);
        $response = $api->request($params, $token);
        if (!empty($response['content']['ids']) && $platform == 'sohu')
        {
            $ids = implode(',', $response['content']['ids']);
            $api_c = $this->api('statusescounts', $platform)->authRedirect(false);
            $resp_c = $api_c->request(array('ids' => $ids), $token);
            if ($resp_c['status'] === true)
            {
                foreach ($response['content']['info'] as $k => $tweet)
                {
                    $response['content']['info'][$k]['retweet_num'] = $resp_c['content'][$tweet['id']]['rcount'];
                    $response['content']['info'][$k]['reply_num'] = $resp_c['content'][$tweet['id']]['ccount'];
                }
            }
        }
        $response['platform'] = $platform;

        return $response;
    }
}

