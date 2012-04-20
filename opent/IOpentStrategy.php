<?php
/**
 * 首先定义opent的接口,每一个相对应的微薄都应该实现相应方法。
 * 基本上以新浪的为主来整合  
 *  @author hezll  hezll@msn.com
 *  @version 1.0beta  
 */ 
interface IOpentStrategy{

/**
 * 关注人列表
 */ 
function friends($cursor, $count, $uid_or_name,$p);
/**      
 * 粉丝列表
 */ 
function follow($uid_or_name); 
      
function followers();
/**
 * 发微薄
 */ 
function update($text);
/**
 * 发图片微薄
 */  
function upload($text,$img);
/**
 * 个人资料
 */ 
function show_user($uid_or_name = null);
} 
