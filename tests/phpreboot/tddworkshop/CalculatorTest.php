<?php

namespace phpreboot\tddworkshop;

use phpreboot\tddworkshop\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function tearDown()
    {
        $this->calculator = null;
    }

    public function testAddReturnsAnInteger()
    {
        $result = $this->calculator->add();
        $this->assertInternalType('integer', $result, 'Result of `add` is not an integer.');
    }
    
    public function testAddWithoutParameterReturnsZero()
    {
        $result = $this->calculator->add();
        $this->assertSame(0, $result, 'Empty string on add do not return 0');
    }
    public function testAddWithSingleNumberReturnsSameNumber()
    {
        $result = $this->calculator->add('3');
        $this->assertSame(3, $result, 'Add with single number do not returns same number');
    }
    
    public function testAddWithTwoParametersReturnsTheirSum()
    {
        $result = $this->calculator->add('2,4');
        $this->assertSame(6, $result,'Add with two parameter do not returns correct sum');
    }
    
    /**
      * @expectedException \InvalidArgumentException
    */
    
    public function testAddWithNonStringParameterThrowsException()
    {
        $this->calculator->add(5,'Integer parameter do not throw error');
    }
     
    /**
       * @expectedException \InvalidArgumentException
    */
    public function testAddWithNonNumbersThrowException()
    {
        $this->calculator->add('1,a','Invalid parameter do not throw exception');
    }
    
    /**
      * @dataProvider addMultipleDataProvider
    */
    
    public function testCaseAddWithMultipleParameter($parameter, $expected){
        
        $result = $this->calculator->add($parameter);
        $this->assertSame($expected, $result,'Add with multiple parameter do not returns correct sum');
    }
    
    public function addMultipleDataProvider(){
        
        return array(
            array('1,2',3),
            array('0,0,0,0,0,0,0',0),
            array('4,7,3,4,7,3,5,6,7,4,3,2,5,7,5,3,4,6,7,8,9,5,5,5,4,3,2', 133),
        );
    }
    
    /**
       @dataProvider newLineDataProvider
    */ 
    
    public function testCaseAddWithNewLineParameter($parameter,$expected){
       
        $result = $this->calculator->add($parameter);
        $this->assertSame($expected, $result,'Add with new line parameter do not returns correct sum');
   
    }
    
    public function newLineDataProvider(){
       
        return array(array('2\n3,4',9));
    }
   
    /**
       @dataProvider delimiterDataProvider
    */  
    
    public function testCaseAddWithDelimiterParameter($parameter,$expected){
       
        $result = $this->calculator->add($parameter);
        $this->assertSame($expected, $result,'Add with delimiter do not returns correct sum');
   
    }
    
    public function delimiterDataProvider(){
       
        return array(array('\\;\\3;4;5',12));
    }
  
    /**
        * @expectedException \InvalidArgumentException
    */
   
    public function testAddWithNegativeParameterThrowsException()
    {
        $this->calculator->add('\\,\\2,7,-3,5,-2','Negative parameter do not throw error');
    }
   
    public function testAddMethodIgnorNumberAbove1000()
    {
        $result = $this->calculator->add('10,20,1010,20');
        $this->assertSame(50, $result, 'Add Method not ignoring numbers above 1000');
    }
   
    /* Test Cases for Multiply Operation */
   
    public function testMultiplyReturnsAnInteger()
    {
        $result = $this->calculator->multiply();
        $this->assertInternalType('integer', $result, 'Result of `multiply` is not an integer.');
    }
    
    public function testMultiplyWithoutParameterReturnsZero()
    {
        $result = $this->calculator->multiply();
        $this->assertSame(0, $result, 'Empty string on multiply do not return 0');
    }
   
    public function testMultiplyWithSingleNumberReturnsSameNumber()
    {
        $result = $this->calculator->multiply('3');
        $this->assertSame(3, $result, 'Multiply with single number do not returns same number');
    }
    public function testMultiplyWithTwoParametersReturnsTheirMultiplication()
    {
        $result = $this->calculator->multiply('2,4');
        $this->assertSame(8, $result,'Multiply with two parameter do not returns correct multiplication');
    }
    
    /**
      * @expectedException \InvalidArgumentException
    */
    
    public function testMultiplyWithNonStringParameterThrowsException()
    {
        $this->calculator->multiply(5,'Integer parameter do not throw error');
    }
     
    /**
       * @expectedException \InvalidArgumentException
    */
    public function testMultiplyWithNonNumbersThrowException()
    {
        $this->calculator->multiply('1,a','Invalid parameter do not throw exception');
    }

    /**
       @dataProvider MultiplyDataProvider
    */
    
    public function testCaseMultiplyWithMultipleParameter($parameter, $expected)
    {
        $result = $this->calculator->multiply($parameter);
        $this->assertSame($expected, $result,'Multiply with multiple parameter do not returns correct multiplication');
    }
    
    public function MultiplyDataProvider(){
        
        return array(
            array('1,2',2),
            array('0,0,0,0,0,0,0',0),
            array('4,7,3', 84),
        );
    }

    /**
       @dataProvider newLineMultiplyDataProvider
    */ 
    
    public function testCaseMultiplyWithNewLineParameter($parameter,$expected){
       
        $result = $this->calculator->multiply($parameter);
        $this->assertSame($expected, $result,'Multiply with new line parameter do not returns correct multiplication');
   
    }
    
    public function newLineMultiplyDataProvider(){
       
        return array(array('2\n3,4',24));
    }
   
    /**
       @dataProvider delimiterMultiplyDataProvider
    */
    
    public function testCaseMultiplyWithDelimiter($parameter,$expected){
       
        $result = $this->calculator->multiply($parameter);
        $this->assertSame($expected, $result,'Multiply with delimiter do not returns correct multiplication');
   
    }
    
    public function delimiterMultiplyDataProvider(){
       
        return array(array('\\;\\3;4;5',60));
    }
   
    /**
       * @expectedException \InvalidArgumentException
    */
   
    public function testMultiplyWithNegativeParameterThrowsException()
    {
        $this->calculator->multiply('\\,\\2,7,-3,5,-2','Negative parameter do not throw error');
    }
   
    public function testMultiplyMethodIgnorNumberAbove1000()
    {
        $result = $this->calculator->multiply('10,20,1010');
        $this->assertSame(200, $result, 'Multiply Method not ignoring numbers above 1000');
    }
}
