# RESTAURANT EXPENSE MANAGER

Expense manager web application for restaurant to keep tab of every day expenses. Custom-made for a particular use case.

### Functionalities 
- Multi-login for Manager and Admin
- Page for manager to add and view daily expenses
- Page for admin to view all the expenses.


So the basic flow goes as follows :
- At the start of the day, the day manager will open the day. He will have to do the following tasks accordingly :
    - Firstly verify the cash in drawer with the previous day cash that was settled in.
        - If the cash matches, it's pretty easy step ahead and he will be able to carry on.
        - If the cash does not match, he'll have to enter the details of the cash in drawer accordingly as per his counting.
            A notification should be shooted to all the admins for this as there is discrepancy in the cash that was in
             last night and the cash that is in the drawer in the morning.
             After this, the manager will be forwarded to the expense list page, which will show all current expense and the
             a option to add new expense.
    - He will carry on with his regular day tasks, the current task that this application solves is maintaining the daily expense
        Majorily all expenses will be noted down on this application with the rate, quantity and amount.
        The flow of the add expense screen will be as follows :
            - Select the vendor. This will have options for all registered vendors, daily expense can be added here too.
                The manager can also add new vendor but by default such vendors will be in active.
            - Select the item, or add new item. The add new item will be helpful for the manager and will present the manager with the form
                to add new item. This item will be inactive as for now. For the time being, the manager will be asked to select
                a Unregistered Vendor.
            - Add a bill, if he has one. This is the only task which is data extensive. The image of the bill will be compressed a bit and
                uploaded to S3.
            - He will be able to verify all the details.
            - This new expense will be added to the list of expenses and shown there too.
            - Notes will be mandatory for any expense made with unregistered vendor or item.
    - During the closing of the day the manager will be asked to enter in details of cash sales, confirm last day cash in drawer and add in
          his current cash in drawer. This will be tallied in with the expense of the day in the system.
          If there is any difference then the owner/admin should be notified about the same.


### What will this system enforce?
    - Responsibility and liability. Every manager has to own his entries.
    - Daily reporting and checking would be very easy.
    - Live Time Expense Tracking for the owners/admin.
    - Daily Tally of the cash sales, expense and cash in drawer.
    - Notification to owner/admin for the regular expense.
