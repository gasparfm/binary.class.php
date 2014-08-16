<?php
  /**
   *************************************************************
   * @file binary.class.php
   * @brief description
   *
   * @author Gaspar Fernández <blakeyed@totaki.com>
   * @version 0.1
   * @date 06 ago 2013
   * Changelog:
   *
   *************************************************************/

/* That's just what I needed for a project, I'll be adding some more stuff
as I need it */

class Binary
{
  protected $value = null;
  protected $flagDefinition = null;
  protected $exceptions = false;

  /**
   * Brief description
   *
   * @param 
   * @param
   */
  public function __construct($initialValue=0, $flagDefinition = array(), $exceptions = false)
  {
    $this->value = $initialValue;
    $this->flagDefinition = $flagDefinition;
    $this->exceptions = $exceptions;
  }

  /**
   * Getter / setter
   *
   * @param $newValue
   */
  public function value($newValue=null)
  {
    if ($newValue!==null)
      $this->value= $newValue;

    return $this->value;
  }

  /**
   * Brief description
   *
   * @param 
   * @param
   */
  private function searchFlag($flag)
  {
    if (is_numeric($flag))
      return $flag;
    else
      {
	$pos = array_search($flag, $this->flagDefinition);

	if ($pos===false)
	  {
	    if ($this->exceptions)
	      throw new BinaryException('Flag not found');
	    return false;
	  }
	return $pos;
      }
  }

  /**
   * Checks a flag
   *
   * @param $flag name or number
   */
  public function checkFlag($flag)
  {
    $flag = $this->searchFlag($flag);
    if ($flag !== false)
      return ($this->value & (1 << $flag));

    return false;
  }

  /**
   * Brief description
   *
   * @param 
   * @param
   */
  public function setFlag($flag)
  {
    $flag = $this->searchFlag($flag);

    if ($flag !== false)
      {
	$this->value |= 1 << $flag;
	return $this->value;
      }

    return false;
  }

  /**
   * Brief description
   *
   * @param 
   * @param
   */
  public function clearFlag($flag)
  {
    $flag = $this->searchFlag($flag);

    if ($flag !== false)
      {
	$this->value &= ~(1 << $flag);
	return $this->value;
      }

    return false;
  }

  /**
   * Brief description
   *
   * @param 
   * @param
   */
  public function toggleFlag($flag)
  {
    $flag = $this->searchFlag($flag);

    if ($flag !== false)
      {
	$this->value ^= (1 << $flag);
	return $this->value;
      }

    return false;
  }

}

class BinaryException extends Exception
{
}

?>
