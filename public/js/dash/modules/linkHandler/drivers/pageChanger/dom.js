define(['dash/modules/widgets/rightPane'], function (rightPaneWidget) {

  var rightPaneHolder = '<div class="span4 offset1" id="rightPaneHolder"></div>';

  var dom = {
    bodyHolder: function () {
      if(this._bodyHolder) return this._bodyHolder;
      this._bodyHolder = $('#bodyHolder');
      this._bodyHolder.setupWithRightPane = function () {
        if(this.hasClass('span18')) {
          this.removeClass('span18').addClass('span12');
          this.after(rightPaneHolder);
          rightPaneWidget.load();
        }

        return this;
      };

      this._bodyHolder.setupWithoutRightPane = function () {
        if(this.hasClass('span12')) {
          this.next().remove();
          this.removeClass('span12').addClass('span18');
        }

        return this;
      };

      return this._bodyHolder;
    }
  }

  return dom;

});