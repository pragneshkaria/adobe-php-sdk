<?php
/*

Modifications done by Renaun Erickson (http://renaun.com) 2006

Copyright (c) 2006. Adobe Systems Incorporated.
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

  * Redistributions of source code must retain the above copyright notice,
    this list of conditions and the following disclaimer.
  * Redistributions in binary form must reproduce the above copyright notice,
    this list of conditions and the following disclaimer in the documentation
    and/or other materials provided with the distribution.
  * Neither the name of Adobe Systems Incorporated nor the names of its
    contributors may be used to endorse or promote products derived from this
    software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
POSSIBILITY OF SUCH DAMAGE.

@ignore
*/

include "DAO.php";
include "../vo/ProductVO.php";

/**
 * DAO responsible for the Product Entity in the database
 * 
 * @version $Revision: 1.2 $
 */
class ProductDAO extends DAO
{

	var $products = array();

	function getEntityName()
	{
		return "Product";
	}

	function listProducts()
	{
		return $this->createProducts();
	}

	function addProduct( $product )
	{

		$this->products[] = $product;
	}

	function createProducts()
	{
		$this->products = array();

		$product1 = new ProductVO();
		$product1->setId( 1 );
		$product1->setName( "USB Watch" );
		$product1->setDescription( "So, you need to tell the time of course, but you also need a way to carry your valuable data with you at all times (you know - your MP3 files, favorite images, your ThinkGeek shopping list). This watch can handle the mission for you and do it in style. It can store up to 256 Megs of data." );
		$product1->setPrice( 129.99 );
		$product1->setImage( "assets/products/usbwatch.jpg" );
		$product1->setThumbnail( "assets/products/usbwatch_sm.jpg" );
		$this->products[] = $product1;

		$product2 = new ProductVO();
		$product2->setId( 2 );
		$product2->setName( "007 Digital Camera" );
		$product2->setDescription( "There is finally a hi-tech gadget from Q''s laboratory that can be had by the measly (albeit smart) masses who are not fortunate enough to carry a license to kill. This inconspicuous Zippo look-alike actually contains a digital camera capable of holding over 300 images." );
		$product2->setPrice( 99.99 );
		$product2->setImage( "assets/products/007camera.jpg" );
		$product2->setThumbnail( "assets/products/007camera_sm.jpg" );
		$this->products[] = $product2;

		$product3 = new ProductVO();
		$product3->setId( 3 );
		$product3->setName( "2-Way Radio Watch" );
		$product3->setDescription( "The only wristwatch with a 2-way radio available to date. It features a built-in 22-channel FRS walkie talkie with a 1.5-mile range. The voice-activated feature allows you to speak into the microphone and your words will be beamed directly to the speaker of any other FRS walkie talkie user." );
		$product3->setPrice( 49.99 );
		$product3->setImage( "assets/products/radiowatch.jpg" );
		$product3->setThumbnail( "assets/products/radiowatch_sm.jpg" );
		$this->products[] = $product3;

		$product4 = new ProductVO();
		$product4->setId( 4 );
		$product4->setName( "USB Desk Fan" );
		$product4->setDescription( "Some people are addicted to fans. They have one running when they sleep (the background noise can be soothing) and they have one on their desk at all times. Other people just like to have a little moving air. Whether you are a fan addict or just a casual user, we have just the device for you." );
		$product4->setPrice( 19.99 );
		$product4->setImage( "assets/products/usbfan.jpg" );
		$product4->setThumbnail( "assets/products/usbfan_sm.jpg" );
		$this->products[] = $product4;

		$product5 = new ProductVO();
		$product5->setId( 5 );
		$product5->setName( "Caffeinated Soap" );
		$product5->setDescription( "Tired of waking up and having to wait for your morning java to brew? Are you one of those groggy early morning types that just needs that extra kick? Introducing Shower Shock, the original and world''s first caffeinated soap. When you think about it, ShowerShock is the ultimate clean buzz ;)" );
		$product5->setPrice( 19.99 );
		$product5->setImage( "assets/products/soap.jpg" );
		$product5->setThumbnail( "assets/products/soap_sm.jpg" );
		$this->products[] = $product5;

		$product6 = new ProductVO();
		$product6->setId( 6 );
		$product6->setName( "Desktop Rovers" );
		$product6->setDescription( "Inspired by NASA''s planetary exploration program, this miniature ''caterpillar drive'' rover belongs officially in the ''way too cool'' category. These mini remote controlled desktop rovers with tank treads are only 4 inches long and ready to explore the 'Alien Landscapes' around your home or office." );
		$product6->setPrice( 49.99 );
		$product6->setImage( "assets/products/rover.jpg" );
		$product6->setThumbnail( "assets/products/rover_sm.jpg" );
		$this->products[] = $product6;

		$product7 = new ProductVO();
		$product7->setId( 7 );
		$product7->setName( "PC Volume Knob" );
		$product7->setDescription( "The coolest volume knob your computer has ever seen and so much more. Use it to edit home movies or scroll through long documents and web pages. Program it to do anything you want in any application. Customize it to your own needs and get wild." );
		$product7->setPrice( 34.99 );
		$product7->setImage( "assets/products/volume.jpg" );
		$product7->setThumbnail( "assets/products/volume_sm.jpg" );
		$this->products[] = $product7;

		$product8 = new ProductVO();
		$product8->setId( 8 );
		$product8->setName( "Wireless Antenna" );
		$product8->setDescription( "A Cantenna is simply an inexpensive version of the long-range antennas used by wireless internet providers and mobile phone companies. Now, with your own Cantenna you can extend the range of your wireless network or connect to other wireless networks in your neighborhood." );
		$product8->setPrice( 49.99 );
		$product8->setImage( "assets/products/cantena.jpg" );
		$product8->setThumbnail( "assets/products/cantena_sm.jpg" );
		$this->products[] = $product8;

		$product9 = new ProductVO();
		$product9->setId( 9 );
		$product9->setName( "TrackerPod" );
		$product9->setDescription( "TrackerPod is a small robotic tripod on which you mount a webcam, and TrackerCam is Artificial Intelligence software to control camera movement from your computer. Together they perform the function of a robotic camera-man for your webcam." );
		$product9->setPrice( 129.99 );
		$product9->setImage( "assets/products/trackerpod.jpg" );
		$product9->setThumbnail( "assets/products/trackerpod_sm.jpg" );
		$this->products[] = $product9;

		$product10 = new ProductVO();
		$product10->setId( 10 );
		$product10->setName( "Caffeinated Sauce" );
		$product10->setDescription( "After months of sleepless nights, we finally came up with something we could bottle up and sell to the masses. A hot sauce (extremely hot btw) that tastes great and has caffeine in it!" );
		$product10->setPrice( 6.99 );
		$product10->setImage( "assets/products/hotsauce.jpg" );
		$product10->setThumbnail( "assets/products/hotsauce_sm.jpg" );
		$this->products[] = $product10;

		$product11 = new ProductVO();
		$product11->setId( 11 );
		$product11->setName( "Thinking Putty" );
		$product11->setDescription( "The Ultimate Stress Reduction office toy is here. Of course you remember playing with putty as a kid. Welp, this aint your kids putty. Adult sized, and as feature-rich as your favorite Operating System, the Smart Mass putty from ThinkGeek makes living life fun all over again." );
		$product11->setPrice( 11.99 );
		$product11->setImage( "assets/products/putty.jpg" );
		$product11->setThumbnail( "assets/products/putty_sm.jpg" );
		$this->products[] = $product11;

		$product12 = new ProductVO();
		$product12->setId( 12 );
		$product12->setName( "Ambient Orb" );
		$product12->setDescription( "The Ambient Orb is a device that slowly transitions between thousands of colors to show changes in the weather, the health of your stock portfolio, or if your boss or friend is on instant messenger. It is a simple wireless object that unobtrusively presents information." );
		$product12->setPrice( 149.99 );
		$product12->setImage( "assets/products/orb.jpg" );
		$product12->setThumbnail( "assets/products/orb_sm.jpg" );
		$this->products[] = $product12;

		$product13 = new ProductVO();
		$product13->setId( 13 );
		$product13->setName( "USB Microscope" );
		$product13->setDescription( "The USB connected Computer Microscope allows you to turn the ordinary into the extraordinary for hours of fun and learning. View specimens collected around the house, backyard, your desk, or the fridge. Look at the micro-printing on a dollar bill or examine the traces on your motherboard." );
		$product13->setPrice( 54.99 );
		$product13->setImage( "assets/products/microscope.jpg" );
		$product13->setThumbnail( "assets/products/microscope_sm.jpg" );
		$this->products[] = $product13;

		$product14 = new ProductVO();
		$product14->setId( 14 );
		$product14->setName( "Flying Saucer" );
		$product14->setDescription( "The flying saucer his surpisingly quiet during operation and so sneaking up on your fellow co-workers is quite easy. The multi-controller Transmitter modulates the thrust from each propeller independently allowing you to take off and land vertically, spin in place, and fly in all directions!" );
		$product14->setPrice( 69.99 );
		$product14->setImage( "assets/products/ufo.jpg" );
		$product14->setThumbnail( "assets/products/ufo_sm.jpg" );
		$this->products[] = $product14;

		$product15 = new ProductVO();
		$product15->setId( 15 );
		$product15->setName( "Levitating Globe" );
		$product15->setDescription( "These electromagnetic suspended globes are actually high-tech instruments. A magnetic field sensor permanently measures the height at which the globes are suspended. This sensor feeds that data into a micro computer in the base of the unit." );
		$product15->setPrice( 89.99 );
		$product15->setImage( "assets/products/globe.jpg" );
		$product15->setThumbnail( "assets/products/globe_sm.jpg" );
		$this->products[] = $product15;

		$product16 = new ProductVO();
		$product16->setId( 16 );
		$product16->setName( "Personal Robot" );
		$product16->setDescription( "The ER1 is the first robot with professional-level robotics software technologies and industrial-grade hardware designed for enthusiasts, like you, who are interested in technology that takes advantage of your technical skills and your imagination." );
		$product16->setPrice( 139.99 );
		$product16->setImage( "assets/products/robot.jpg" );
		$product16->setThumbnail( "assets/products/robot_sm.jpg" );
		$this->products[] = $product16;

		return $this->products;
	}

}
?>