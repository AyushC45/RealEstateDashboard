import pandas as pd
import matplotlib.pyplot as plt
import mysql.connector
from mysql.connector import Error
import matplotlib.ticker as ticker
from matplotlib.ticker import FuncFormatter

def connect_fetch_data():
    """Connect to the MySQL database and fetch data."""
    try:
        connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='real_estate_db'
        )
        if connection.is_connected():
            query = "SELECT location, price FROM properties"
            df = pd.read_sql(query, connection)
            return df
    except Error as e:
        print(f"Error: {e}")
    finally:
        if connection.is_connected():
            connection.close()

def format_tick_label(x, pos):
    """Custom formatter to convert the x-axis labels to the desired format."""
    return f'{int(x/1000)}'

def visualize_data(df):
    """Generate and save visualizations for property data."""
    # Average Price by Location
    avg_prices = df.groupby('location')['price'].mean().sort_values()
    plt.figure(figsize=(10, 8))
    ax1 = avg_prices.plot(kind='barh', color='skyblue')
    plt.title('Average Property Price by Location (In Thousands)')
    plt.xlabel('Average Price (In Thousands)')
    plt.ylabel('Location')
    ax1.xaxis.set_major_locator(ticker.MultipleLocator(100000))
    ax1.xaxis.set_major_formatter(FuncFormatter(format_tick_label))
    plt.tight_layout()
    plt.savefig('D:/Xampp/htdocs/RealEstateApp/assets/average_price_by_location.png')
  

    # Number of Listings by Location
    listings_count = df.groupby('location')['price'].count().sort_values()
    plt.figure(figsize=(10, 8))
    ax2 = listings_count.plot(kind='barh', color='lightgreen')
    plt.title('Number of Listings by Location')
    plt.xlabel('Number of Listings')
    plt.ylabel('Location')
    plt.tight_layout()
    plt.savefig('D:/Xampp/htdocs/RealEstateApp/assets/listings_by_location.png')
  

if __name__ == "__main__":
    df = connect_fetch_data()
    if df is not None:
        visualize_data(df)
