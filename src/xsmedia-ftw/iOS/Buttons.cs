using System;
using UIKit;
using CoreGraphics;
using Foundation;

namespace Trafficing.iOS
{
	public class Buttons : UIViewController
	{
		public Buttons()
		{
		}

		public static void CreateAppName(UIView view) { 
			var name = new UIImageView(UIImage.FromBundle("Name"));
			name.Frame = new CoreGraphics.CGRect(10, 50, 140, 30);
			view.AddSubview(name);
		}

		public static void CreateLogo(UIView view) { 
			var logo = new UIImageView(UIImage.FromBundle("Logo"));
			logo.Frame = new CoreGraphics.CGRect(170, 32, 60, 60);
			view.AddSubview(logo);
		}

		public static void CreateMenu(UIView view) { 
			var menu = UIButton.FromType(UIButtonType.Custom);
			menu.SetImage(UIImage.FromBundle("Menu"),UIControlState.Normal);
			menu.Frame = new CoreGraphics.CGRect(300, 40, 50, 50);
			view.AddSubview(menu);
		}

		public static void CreateHome(UIView view) { 
			var home = UIButton.FromType(UIButtonType.Custom);
			home.SetImage(UIImage.FromBundle("Home"), UIControlState.Normal);
			home.Frame = new CoreGraphics.CGRect(30, 590, 55, 60);
			view.AddSubview(home);
		}

		public static void CreateReport(UIView view) { 
			var report = UIButton.FromType(UIButtonType.Custom);
			report.SetImage(UIImage.FromBundle("Report"), UIControlState.Normal);
			report.Frame = new CoreGraphics.CGRect(170, 590, 50, 50);
			view.AddSubview(report);

			report.TouchUpInside += (sender, e) => {
				Globals.reportView = true;
			};
		}

		public static void Create911(UIView view) { 
			var call911 = UIButton.FromType(UIButtonType.Custom);
			call911.SetImage(UIImage.FromBundle("911"), UIControlState.Normal);
			call911.Frame = new CoreGraphics.CGRect(300, 590, 40, 60);
			view.AddSubview(call911);

			call911.TouchUpInside += (sender, e) => {
				var url = new NSUrl("tel://911");
				UIApplication.SharedApplication.OpenUrl(url);
			};
		}

		public static void CreateReportBtn(UIView view) { 
			var reportBtn = UIButton.FromType(UIButtonType.Custom);
			reportBtn.SetImage(UIImage.FromBundle("ReportButton"), UIControlState.Normal);
			reportBtn.Frame = new CoreGraphics.CGRect(65, 180, 250, 70);
			view.AddSubview(reportBtn);

			reportBtn.TouchUpInside += (sender, e) => {
				Globals.reportView = true;
			};
		}

		public static void CreateGuideBtn(UIView view) { 
			var guideBtn = UIButton.FromType(UIButtonType.Custom);
			guideBtn.SetImage(UIImage.FromBundle("GuideButton"), UIControlState.Normal);
			guideBtn.Frame = new CoreGraphics.CGRect(65, 460, 250, 70);
			view.AddSubview(guideBtn);
		}

		public static void CreateHeaderFooter(UIView view) {
			Buttons.CreateAppName(view);
			Buttons.CreateLogo(view);
			Buttons.CreateMenu(view);
			Buttons.CreateHome(view);
			Buttons.CreateReport(view);
			Buttons.Create911(view);
		}
	}
}
