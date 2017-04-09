using UIKit;
using CoreGraphics;
using Foundation;
using MessageUI;

namespace Trafficing.iOS
{
	public class ReportView : UIViewController
	{
		BlankView blankView;
		ReportSplash reportSplash;
		ReportFooter reportFooter;

		UIScrollView scrollView;

		UITextField dateField;
		UITextField timeField;
		UITextField makeField;
		UITextField modelField;
		UITextField licenseField;
		UITextField driverField;
		UITextField genderField;
		UITextField raceField;
		UITextField heightField;
		UITextField ageField;
		UITextField hairCField;
		UITextField hairLField;
		UITextField eyeField;

		MFMailComposeViewController mailController;

		public override UIStatusBarStyle PreferredStatusBarStyle()
		{
			return UIStatusBarStyle.LightContent;
		}

		public override void LoadView()
		{
			var openningView = new ViewController();

			blankView = new BlankView() { Frame = UIScreen.MainScreen.Bounds };
			reportSplash = new ReportSplash() { Frame = UIScreen.MainScreen.Bounds };
			reportFooter = new ReportFooter() { Frame = new CGRect(0,0,375,2000) };
			View = blankView;
			View.AddSubview(reportSplash);
			View.AddSubview(reportFooter);

			//app name
			var name = new UIImageView(UIImage.FromBundle("Name"));
			name.Frame = new CGRect(10, 50, 140, 30);
			View.AddSubview(name);

			//logo
			var logo = new UIImageView(UIImage.FromBundle("Logo"));
			logo.Frame = new CGRect(175, 32, 35, 60);
			View.AddSubview(logo);

			//menu
			var menu = UIButton.FromType(UIButtonType.Custom);
			menu.SetImage(UIImage.FromBundle("Menu"),UIControlState.Normal);
			menu.Frame = new CGRect(300, 40, 50, 50);
			View.AddSubview(menu);

			//call911
			var call911 = UIButton.FromType(UIButtonType.Custom);
			call911.SetImage(UIImage.FromBundle("911"), UIControlState.Normal);
			call911.Frame = new CoreGraphics.CGRect(170, 890, 30, 60);
			View.AddSubview(call911);

			call911.TouchUpInside += delegate {
				var url = new NSUrl("tel://911");
				UIApplication.SharedApplication.OpenUrl(url);
			};

			//back
			var backButton = UIButton.FromType(UIButtonType.Custom);
			backButton.SetImage(UIImage.FromBundle("BackButton"), UIControlState.Normal);
			backButton.Frame = new CGRect(30, 890, 70, 60);
			View.AddSubview(backButton);

			backButton.TouchUpInside += delegate {
				openningView = new ViewController();
				PresentViewController(openningView, true, null);
			};

			//date field
			dateField = new UITextField
			{
				Placeholder = "MM/DD/YYYY",
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 85, 130, 30)
			};
			View.AddSubview(dateField);

			//time field
			timeField = new UITextField
			{ 
				Placeholder = "ex. 1:00 PM",
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 125, 130,30)
			};
			View.AddSubview(timeField);

			//make field
			makeField = new UITextField 
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 255, 130,30)
			};
			View.AddSubview(makeField);

			//model field
			modelField = new UITextField
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 295, 130,30)
			};
			View.AddSubview(modelField);

			//license plate field
			licenseField = new UITextField
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 335, 130,30)
			};
			View.AddSubview(licenseField);

			//driver field
			driverField = new UITextField
			{
				Placeholder = "i.e. Pimp, Buyer, Victim",
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(150, 375, 200, 30)
			};
			View.AddSubview(driverField);

			//gender field
			genderField = new UITextField
			{
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 525, 130, 30)
			};
			View.AddSubview(genderField);

			//race field
			raceField = new UITextField
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 565, 130, 30)
			};
			View.AddSubview(raceField);

			//height field
			heightField = new UITextField 
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 605, 130, 30)
			};
			View.AddSubview(heightField);

			//age field
			ageField = new UITextField
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 645, 130, 30)
			};
			View.AddSubview(ageField);

			//hair color field
			hairCField = new UITextField
			{
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 685, 130, 30)
			};
			View.AddSubview(hairCField);

			//hair length field
			hairLField = new UITextField
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 725, 130, 30)
			};
			View.AddSubview(hairLField);

			//eye color field
			eyeField = new UITextField
			{ 
				BorderStyle = UITextBorderStyle.RoundedRect,
				Frame = new CGRect(220, 765, 130, 30)
			};
			View.AddSubview(eyeField);

			//next
			var nextButton = UIButton.FromType(UIButtonType.Custom);
			nextButton.SetImage(UIImage.FromBundle("NextButton"), UIControlState.Normal);
			nextButton.Frame = new CGRect(270, 890, 70, 60);
			View.AddSubview(nextButton);

			nextButton.TouchUpInside += delegate {
				if (MFMailComposeViewController.CanSendMail){
					mailController = new MFMailComposeViewController();
					mailController.SetToRecipients(new string[] { "katiekizer09@gmail.com" });
					mailController.SetSubject("TraffickStop Report");
					mailController.SetMessageBody("New TraffickStop Report at " + timeField.Text + " on "
												  + dateField.Text + ".\nVehicle Involved\nMake:", false);
				}
			};

			//scroll view
			scrollView = new UIScrollView
			{
				Frame = new CGRect(0,103,375,600),
				ContentSize = new CGSize(375,2000)
			};
			View.AddSubview(scrollView);
			scrollView.AddSubviews(new UIView[] {
				reportFooter, backButton, nextButton, call911, dateField,
				timeField, makeField, modelField, licenseField, driverField,
				genderField, raceField, heightField, ageField, hairCField,
				hairLField, eyeField
			});

		}
	}
}
