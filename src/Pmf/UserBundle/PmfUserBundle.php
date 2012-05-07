<?php

namespace Pmf\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PmfUserBundle extends Bundle
{	
	/**
	 * - extends FOSUserBundle
	 */
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
