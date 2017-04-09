using UIKit;
using CoreGraphics;
using Foundation;

namespace Trafficing.iOS
{
	public partial class ViewController : UIViewController
	{
		OpenningSplash openningSplash;

		public ViewController()
		{
		}

		public override UIStatusBarStyle PreferredStatusBarStyle()
		{
			return UIStatusBarStyle.LightContent;
		}

		public override void ViewDidLoad()
		{
			base.ViewDidLoad();

			var reportView = new ReportView();

			openningSplash = new OpenningSplash() { Frame = UIScreen.MainScreen.Bounds };
			View.AddSubview(openningSplash);

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

			//home
			var home = UIButton.FromType(UIButtonType.Custom);
			home.SetImage(UIImage.FromBundle("Home"), UIControlState.Normal);
			home.Frame = new CGRect(30, 590, 55, 60);
			View.AddSubview(home);

			//report
			var report = UIButton.FromType(UIButtonType.Custom);
			report.SetImage(UIImage.FromBundle("Report"), UIControlState.Normal);
			report.Frame = new CGRect(170, 590, 50, 50);
			View.AddSubview(report);

			report.TouchUpInside += delegate {
				reportView = new ReportView();
				PresentViewController(reportView, true, null);
			};

			//call911
			var call911 = UIButton.FromType(UIButtonType.Custom);
			call911.SetImage(UIImage.FromBundle("911"), UIControlState.Normal);
			call911.Frame = new CGRect(300, 590, 30, 60);
			View.AddSubview(call911);

			call911.TouchUpInside += delegate {
				var url = new NSUrl("tel://911");
				UIApplication.SharedApplication.OpenUrl(url);
			};

			//report button
			var reportBtn = UIButton.FromType(UIButtonType.Custom);
			reportBtn.SetImage(UIImage.FromBundle("ReportButton"), UIControlState.Normal);
			reportBtn.Frame = new CGRect(65, 180, 250, 70);
			View.AddSubview(reportBtn);

			reportBtn.TouchUpInside += delegate {
				reportView = new ReportView();
				PresentViewController(reportView, true, null);
			};

			//guide button
			var guideBtn = UIButton.FromType(UIButtonType.Custom);
			guideBtn.SetImage(UIImage.FromBundle("GuideButton"), UIControlState.Normal);
			guideBtn.Frame = new CGRect(65, 460, 250, 70);
			View.AddSubview(guideBtn);
		}

		public override void DidReceiveMemoryWarning()
		{
			base.DidReceiveMemoryWarning();
			// Release any cached data, images, etc that aren't in use.		
		}
	}
}
