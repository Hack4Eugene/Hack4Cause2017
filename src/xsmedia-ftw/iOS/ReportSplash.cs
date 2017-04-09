using UIKit;
using CoreGraphics;

namespace Trafficing.iOS
{
	public class ReportSplash : UIView
	{
		public ReportSplash()
		{
			BackgroundColor = UIColor.Clear;
		}

		public override void Draw(CGRect rect)
		{
			base.Draw(rect);

			using (CGContext g = UIGraphics.GetCurrentContext()) {
				//iphone header box
				UIColor.Clear.SetStroke();
				UIColor.Black.SetFill();

				var path3 = new CGPath();
				path3.AddLines(new CGPoint[]{
					new CGPoint(-5,-5),
					new CGPoint(400, -5),
					new CGPoint(400, 50),
					new CGPoint(-5, 50)});

				path3.CloseSubpath();

				g.AddPath(path3);
				g.DrawPath(CGPathDrawingMode.FillStroke);

				//header box
				g.SetLineWidth(6);
				UIColor.Gray.SetStroke();
				UIColor.Black.SetFill();

				var path = new CGPath();
				path.AddLines(new CGPoint[]{
					new CGPoint(3,25),
					new CGPoint(372,25),
					new CGPoint(372,100),
					new CGPoint(3,100)});

				path.CloseSubpath();

				g.AddPath(path);
				g.DrawPath(CGPathDrawingMode.FillStroke);
			}
		}
	}
}
